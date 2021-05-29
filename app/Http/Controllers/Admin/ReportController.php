<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use App\Model\Order;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start=$request->start;
        $end=$request->end;
        if($request->type=='sale'){
            $order_status=$request->order_status;
            $payment_status=$request->payment_status;
            $orders=DB::table('orders')->groupBy(DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m-%d')"))->when($start,function ($query, $start) {
                return $query->where('orders.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('orders.created_at','<=', $end);
            })
            ->when($order_status,function ($query, $order_status) {
                return $query->where('status','=', $order_status);
            })
            ->when($payment_status,function ($query, $payment_status) {
                return $query->where('payment_status','=', $payment_status);
            })
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw('DATE_FORMAT(orders.created_at, "%Y-%m-%d") as created_at,count(*) as no_order,sum(total) as total,sum(qty) as product_count,sum(discount) as discount,sum(shipping_cost) as shipping_cost,sum(tax) as tax')
            ->paginate(20);
            $links=$orders->appends($_GET)->links();
            return view('admin.report.index',compact('orders','links'));
        }
        else if($request->type=='order'||!$request->type){
            $order_status=$request->order_status;
            $payment_status=$request->payment_status;
            $orders=DB::table('orders')->groupBy('customer_email')->when($start,function ($query, $start) {
                return $query->where('orders.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('orders.created_at','<=', $end);
            })
            ->when($order_status,function ($query, $order_status) {
                return $query->where('status','=', $order_status);
            })
            ->when($payment_status,function ($query, $payment_status) {
                return $query->where('payment_status','=', $payment_status);
            })
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw('count(*) as no_order,sum(qty) as product_count,customer_first_name,customer_last_name, customer_email,customer_id,sum(total) as total,sum(discount) as discount')
            ->paginate(20);
            $links=$orders->appends($_GET)->links();
            return view('admin.report.index',compact('orders','links'));
        }
        else if($request->type=='product'){
            $products=DB::table('products')->groupBy('products.id')->when($start,function ($query, $start) {
                return $query->where('order_products.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('order_products.created_at','<=', $end);
            })
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->selectRaw('products.name,count(*) as order_count,products.id,sum(order_products.qty) as sold,sum(order_products.line_total) as total')
            ->paginate(20);
            $links=$products->appends($_GET)->links();
            return view('admin.report.index',compact('products','links'));
        }
        else if($request->type=='coupon'){
            $coupons=DB::table('coupons')->groupBy('coupons.id')->when($start,function ($query, $start) {
                return $query->where('orders.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('orders.created_at','<=', $end);
            })
            ->join('orders', 'orders.coupon_id', '=', 'coupons.id')
            ->selectRaw('coupons.code,count(*) as order_count,coupons.limit,coupons.used,sum(orders.discount) as discount,sum(orders.total) as total,start,end')
            ->paginate(20);
            $links=$coupons->appends($_GET)->links();
            return view('admin.report.index',compact('coupons','links'));
        }
        else if($request->type=='payment-gateway'){
            $gateways=DB::table('orders')->groupBy('payment_method')->when($start,function ($query, $start) {
                return $query->where('orders.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('orders.created_at','<=', $end);
            })
            ->where('status','!=',6)
            ->selectRaw('count(*) as order_count,sum(orders.discount) as discount,sum(orders.total) as total,payment_method,sum(tax) as tax,sum(shipping_cost) as cost,SUM(IF(payment_status = "1", total, 0)) AS paid,SUM(IF(payment_status = "0", total, 0)) AS unpaid')
            ->paginate(20);
            $links=$gateways->appends($_GET)->links();
            return view('admin.report.index',compact('gateways','links'));
        }
        else if($request->type=='page'){
            $pages=DB::table('site_visits')->groupBy(['visit_date'])->when($start,function ($query, $start) {
                return $query->where('site_visits.created_at','>=', $start);
            })->when($end,function ($query, $end) {
                return $query->where('site_visits.created_at','<=', $end);
            })->select(DB::raw('visit_date,count(*) as visits,SUM(IF(is_new = "1", 1, 0)) as new_visitors,COUNT(DISTINCT ip) as unique_visitor '))->orderBy('visit_date','desc')->paginate(20);

            $links=$pages->appends($_GET)->links();
            return view('admin.report.index',compact('pages','links'));
        }
        
        return view('admin.report.index');
    }
}
