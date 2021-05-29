<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Services\AffiliateService;
use App\Services\Datatable;
use App\Services\LanguageService;
use App\Services\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "order";
        $user = auth()->user();
        if (request()->ajax()) {
            $curr = Session::get('currency');
            $sign = $curr->sign;
            $rate = $curr->rate;
            $table = new Datatable('Order', 'order');
            return $table->get(['id','order_number', 'cart', 'customer_first_name', 'customer_email', 'customer_last_name', 'status', 'payment_status', 'sub_total'])->addColumn('index', function ($row) {
                return '<div class="icheck-primary d-inline">
                <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                <label for="checkboxPrimary' . $row->id . '">
                </label>
              </div>';
            })
                ->addColumn('customer_name', function ($row) {
                    return $row->customer_first_name;
                })
                ->addColumn('details', function ($row) use ($rate, $sign) {
                    $items = unserialize(bzdecompress(utf8_decode($row->cart)));
                    $details = "<table class='table table-bordered'>";
                    $total = $sign . ($row->sub_total * $rate);
                    foreach ($items as $item) {
                        $price = $sign . ($item->subtotal * $rate);
                        $details .= "<tr><td style='border:1px solid #f1f1f1'>
                    ".Str::limit($item->name,20,'')."   
                    </td><td style='border:1px solid #f1f1f1'>
                    $item->qty   
                    </td><td style='border:1px solid #f1f1f1'>
                      $price
                    </td></tr>";
                    }
                    $details .= "<tr><td colspan='2' style='border:1px solid #f1f1f1'>Total</td><td style='border:1px solid #f1f1f1'>$total</td></tr>";
                    $details .= "</table>";
                    return $details;
                })
                ->editColumn('status_text', function ($row) {
                    return $row->statusText();
                })
                ->editColumn('payment_status', function ($row) {
                    $checked = "";
                    if ($row->payment_status == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                <input data-href="' . URL::to('admin/order/payment-status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
                })

                ->addColumn('action', function ($row) use ($user, $route) {
                    $btn = '<span class="ts-action-btn mr-2">
                <a href="' . route($route . ".show", $row->id) . '"><i class="ri-eye-line"></i></a>
                </span> ';
                    if ($user->can($route . '.destroy')) {
                        $btn .= '<span class="ts-action-btn">
                    <a class="delete-button" href="#" data-href="' . route($route . ".destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
                    </span>';
                    }
                    return $btn;
                })->rawColumns(['action', 'index', 'status', 'payment_status', 'details'])
                ->make(true);
        }
        return view('admin.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.show', compact('order', 'items'));
    }
    public function updateAddress(Order $order){
        $order->update([
            "billing_address_1"=>request()->billing_address_1
            ]);
        return back()->with('success','Address updated successfully');
    }

    public function printOrder(Order $order)
    {
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.print', compact('order', 'items'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return LanguageService::getTranslate("OrderDeletedSuccessfully");
    }
    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $order = Order::find($id);
            $order->delete();
        }
        return LanguageService::getTranslate("OrderDeletedSuccessfully");
    }
    public function updateStatus(Order $order, $status)
    {
        $order->update([
            "status" => $status
        ]);
        $order->tracks()->create([
            "title" => "Order status update",
            "details" => "OrderStatusUpdatedTo" . $order->statusText(),
        ]);
        /**
         * Notify user
         */
        Notification::orderUpdateUser($order->id);
        /**
         * Update stock if order completed
         */
        if ($status == 3) {
            $items = unserialize(bzdecompress(utf8_decode($order->cart)));
            foreach ($items as $item) {
                $product = Product::find($item->options->productId);
                $product->qty -= $item->qty;
                $product->save();
                if (Session::get('flashSaleProducts')) {
                    if (in_array($this->attributes["id"], Session::get('flashSaleProducts'))) {
                        $flashSale = FlashSale::where('is_active', 1)->first();
                        $flashSaleProduct = $flashSale->products->where('product_id', $this->attributes["id"])->first();
                        $flashSaleProduct->qty -= $item->qty;
                        $flashSaleProduct->save();
                    }
                }
            }
        }
        return LanguageService::getTranslate("OrderUpdatedSuccessfully");
    }
    public function updatePaymentStatus(Order $order, $status)
    {
        $order->update([
            "payment_status" => $status
        ]);
        Notification::orderUpdateUser($order->id);
        $affiliateService = new AffiliateService();
        $affiliateService->payToAffiliator($order->id);
        
        $order->tracks()->create([
            "title" => "Payment update",
            "details" => "Payment status updated to " . $order->paymentStatusText(),
        ]);
        return LanguageService::getTranslate("OrderUpdatedSuccessfully");
    }


    public function multiStatus($status, $ids)
    {
        foreach (json_decode($ids) as $id) {
            $order = Order::find($id);
            $order->update([
                "status" => $status
            ]);
            Notification::orderUpdateUser($order->id);
        }
        return LanguageService::getTranslate("OrderUpdatedSuccessfully");
    }
}
