<?php

namespace App\Http\Controllers\Admin;

use App\Model\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Model\CampaignProduct;
use App\Model\Product;
use App\Model\Shop;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Cache;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "campaign";
        $user = auth()->user();
        if (request()->ajax()) {
            $table = new Datatable('Campaign', 'campaign');
            return $table->get()->addColumn('index', function ($row) {
                return '<div class="icheck-primary d-inline">
                <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                <label for="checkboxPrimary' . $row->id . '">
                </label>
              </div>';
            })
                ->editColumn('image', function ($row) {
                    return "<img class='data-table-img' src='" . asset('images/campaign/' . $row->image) . "'>";
                })
                ->addColumn('status', function ($row) {
                    $checked = "";
                    if ($row->is_active == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                <input data-href="' . URL::to('admin/campaign/status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
                })
                ->addColumn('created', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) use ($user, $route) {
                    $btn = '';
                    if ($user->can($route . '.edit')) {
                        $btn .= '<span class="ts-action-btn mr-2">
                    <a href="' . route($route . ".edit", $row->id) . '"><i class="ri-pencil-line"></i></a>
                </span> ';
                    }

                    if ($user->can($route . '.destroy')) {
                        $btn .= '<span class="ts-action-btn">
                <a class="delete-button" href="#" data-href="' . route($route . ".destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
            </span>';
                    }
                    return $btn;
                })->rawColumns(['action', 'index', 'image', 'status'])
                ->make(true);
        }

        return view('admin.campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        $shops = Shop::all();
        return view('admin.campaign.create', compact('products', 'shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $campaign = Campaign::create([
            "title" => $request->title,
            "is_active" => 1,
            "image" => $request->image,

        ]);
        if ($request->shop) {
            $shop = Shop::find($request->shop);
            foreach ($shop->products as $product) {
                //updateOrCreate
                $campaign->products()->updateOrCreate([
                    "product_id" => $product->id,
                    "price" => ceil($product->price * (100 - $request->percentage) * 0.01),
                    "qty" => 20,
                ]);
            }
        }
        if ($request->product) {
            for ($i = 0; $i < count($request->product); $i++) {
                $product = Product::find($request->product[$i]);
                if ($product) {
                    $product->update([
                        'campaign_id' => $campaign->id
                    ]);
                    if ($request->price[$i]) {
                        $campaign->products()->create([
                            "product_id" => $request->product[$i],
                            "price" => $request->price[$i],
                            "qty" => $request->qty[$i],
                        ]);
                    }
                }
            }
        }

        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('Campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return redirect()->route('campaign.index')->with('success', LanguageService::getTranslate('FlashSaleCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $products = Product::orderBy('name')->get();
        return view('admin.campaign.edit', compact('campaign', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update([
            "title" => $request->title,
            "is_active" => 1,
            "image" => $request->image,

        ]);
        foreach ($campaign->products as $product) {
            $product->delete();
        }
        for ($i = 0; $i < count($request->product); $i++) {
            $product = Product::find($request->product[$i]);
            $product->update([
                'campaign_id' => $campaign->id
            ]);
            if ($request->price[$i]) {
                $campaign->products()->create([
                    "product_id" => $request->product[$i],
                    "price" => $request->price[$i],
                    "qty" => $request->qty[$i],
                ]);
            }
        }
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('Campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return redirect()->route('campaign.index')->with('success', LanguageService::getTranslate('FlashSaleUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $campaign = Campaign::find($id);
            $campaign->delete();
        }
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
    public function updateStatus(Campaign $campaign, $status)
    {
        if ($status == 1) {
            Campaign::where('is_active', 1)->update(['is_active' => 0]);
        }
        $campaign->update([
            "is_active" => $status
        ]);
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('Campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleUpdatedSuccessfully");
    }

    public function multiStatus($status, $ids)
    {
        foreach (json_decode($ids) as $id) {
            $campaign = Campaign::find($id);
            $campaign->update([
                "is_active" => $status
            ]);
        }
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('Campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleUpdatedSuccessfully");
    }
    public function removecampaignProduct($id)
    {
        $campaignProduct = CampaignProduct::find($id);
        $campaignProduct->delete();
        $campaign = Campaign::where('is_active', 1)->with(['products', 'campaignProducts'])->orderBy('id', 'desc')->first();
        if ($campaign) {
            $campaignProducts = CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id')->toArray();
        }
        Cache::put('Campaign', $campaign, now()->addMinutes(10));
        Cache::put('campaignProducts', $campaignProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
}
