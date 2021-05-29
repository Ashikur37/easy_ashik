<?php

namespace App\Http\Controllers\Admin;

use App\Model\AffiliateProduct;
use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "affiliate";
        $user = auth()->user();
        if (request()->ajax()) {
            $table = new Datatable('AffiliateProduct', 'affiliate', 'product');
            return $table->get()
                ->addColumn('index', function ($row) {
                    return '<div class="icheck-primary d-inline">
                <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                <label for="checkboxPrimary' . $row->id . '">
                </label>
              </div>';
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product->name;
                })
                ->addColumn('image', function ($row) {
                    return "<img class='data-table-img' src='" . asset('images/product/' . $row->product->image) . "'>";
                })
                ->editColumn('status', function ($row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                <input data-href="' . URL::to('admin/affiliate/status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
                })
                ->addColumn('action', function ($row) use ($user, $route) {
                    $btn = '
            <span class="ts-action-btn">
                <a class="delete-button" href="#" data-href="' . route($route . ".destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
            </span>';

                    return $btn;
                })->rawColumns(['action', 'index', 'status', 'image'])
                ->make(true);
        }

        return view('admin.affiliate.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AttributeCategory  $attributeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $affiliateProducts = AffiliateProduct::orderBy('percentage')->get()->groupBy('percentage');
        $products = Product::orderBy('name')->get();
        return view('admin.affiliate.edit', compact('products', 'affiliateProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AttributeCategory  $attributeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $setting = Setting::first();
        $setting->update([
            "global_affiliate_percent" => $request->global_affiliate_percent
        ]);
        $proucts = AffiliateProduct::all();

        foreach ($proucts as $product) {
            $product->delete();
        }

        foreach ($request->percent as $id => $percent) {
            if ($percent) {
                foreach ($request->product[$id] as $product) {
                    AffiliateProduct::updateOrCreate([
                        "product_id" => $product
                    ], [
                        "percentage" => $percent
                    ]);
                }
            }
        }
        return redirect()->route('affiliate.index')->with('success', LanguageService::getTranslate('AffiliationUpdatedSuccessfully'));
    }


    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $affiliateProduct = AffiliateProduct::find($id);
            $affiliateProduct->delete();
        }
        return LanguageService::getTranslate("AffiliationProductDeletedSuccessfully");
    }
    public function updateStatus(AffiliateProduct $affiliateProduct, $status)
    {
        $affiliateProduct->update([
            "status" => $status
        ]);
        return LanguageService::getTranslate("AffiliationProductUpdatedSuccessfully");
    }

    public function multiStatus($status, $ids)
    {
        foreach (json_decode($ids) as $id) {
            $affiliateProduct = AffiliateProduct::find($id);
            $affiliateProduct->update([
                "status" => $status
            ]);
        }
        return LanguageService::getTranslate("AffiliationProductUpdatedSuccessfully");
    }
}
