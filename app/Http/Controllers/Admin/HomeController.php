<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\ProductComment;
use App\Model\Review;
use App\Model\SiteVisit;
use App\Model\Ticket;
use App\User;
use Carbon\Carbon;
class HomeController extends Controller
{

    public function index()
    {
        $totalSale = Order::where(
            'created_at',
            '>=',
            Carbon::now()->subDay(30)
        )->sum('total');
        $totalPrevSale = Order::whereBetween(
            'created_at',
            [Carbon::now()->subDay(60), Carbon::now()->subDay(30)]
        )->sum('total');
        if (!$totalPrevSale) {
            $totalPrevSale = 1;
        }
        $totalSaleGrowth = (($totalSale - $totalPrevSale) / $totalPrevSale) * 100;
        $totalSale = Product::currencyPriceRate($totalSale);


        $totalSaleCount = Order::where(
            'created_at',
            '>=',
            Carbon::now()->subDay(30)
        )->count();
        $totalPrevSaleCount = Order::whereBetween(
            'created_at',
            [Carbon::now()->subDay(60), Carbon::now()->subDay(30)]
        )->count();
        if (!$totalPrevSaleCount) {
            $totalPrevSaleCount = 1;
        }
        $totalSaleCountGrowth = (($totalSaleCount - $totalPrevSaleCount) / $totalPrevSaleCount) * 100;


        $totalCustomerCount = User::where(
            'created_at',
            '>=',
            Carbon::now()->subDay(30)
        )->where('type', 0)->count();
        $totalPrevCustomerCount = User::whereBetween(
            'created_at',
            [Carbon::now()->subDay(60), Carbon::now()->subDay(30)]
        )->where('type', 0)->count();
        if (!$totalPrevCustomerCount) {
            $totalPrevCustomerCount = 1;
        }
        $totalCustomerGrowth = (($totalCustomerCount - $totalPrevCustomerCount) / $totalPrevCustomerCount) * 100;

        $productSoldCount = OrderProduct::where(
            'created_at',
            '>=',
            Carbon::now()->subDay(30)
        )->sum('qty');
        $productPrevSoldCount = OrderProduct::whereBetween(
            'created_at',
            [Carbon::now()->subDay(60), Carbon::now()->subDay(30)]
        )->sum('qty') || 1;
        $productSoldGrowth = (($productSoldCount - $productPrevSoldCount) / $productPrevSoldCount) * 100;
        $visitors = [];
        $unique_visitors = [];
        $days = [];
        

        for ($i = 6; $i >= 0; $i--) {
            array_push($days, Carbon::now()->subDay($i)->format('D'));
            array_push($visitors, SiteVisit::where(
                'visit_date',
                '=',
                Carbon::now()->subDay($i)->format('Y-m-d')
            )->count());
            array_push($unique_visitors, SiteVisit::where(
                'visit_date',
                '=',
                Carbon::now()->subDay($i)->format('Y-m-d')
            )->distinct('ip')->count());
        }

        $processingCount = Order::where('status', 1)->count();
        $completedCount = Order::where('status', 3)->count();
        $pendingCount = Order::where('status', 0)->count();
        $cancelCount = Order::where('status', 6)->count(); 
        $otherCount = Order::where('status', '!=', 3)->count();
        $months = [];
        $organicOrders = [];
        $couponOrders = [];
        $affiliateOrders = [];
        $monthOrders = [];
        $monthSales = [];
        for ($i = 5; $i >= 0; $i--) {
            array_push($months, Carbon::now()->subMonth($i)->format('M'));
            array_push($organicOrders, Order::whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth($i)->format('m')
            )->where('coupon_id', 0)->where('affiliator', 0)->count());
            array_push($couponOrders, Order::whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth($i)->format('m')
            )->where('coupon_id', '!=', 0)->count());
            array_push($affiliateOrders, Order::whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth($i)->format('m')
            )->where('affiliator', '!=', 0)->count());
            array_push($monthOrders, Order::whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth($i)->format('m')
            )->count());
            array_push($monthSales, round(Order::whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth($i)->format('m')
            )->sum('total') / 1000));
        }
        $recentOrders = Order::latest()->limit(5)->get();
        $recentNotifications = auth()->user()->notifications->take(4);
        $recentTickets = Ticket::latest()->limit(4)->get();
        $recentReviews = Review::latest()->limit(4)->get();
        $recentComments = ProductComment::latest()->limit(4)->get();
        $topProducts = Product::orderBy('viewed', 'desc')->limit(4)->get();

        return view('admin.home.index', compact('unique_visitors', 'recentOrders', 'recentNotifications', 'recentTickets', 'recentReviews', 'recentComments', 'topProducts', 'monthOrders', 'monthSales', 'months', 'organicOrders', 'couponOrders', 'affiliateOrders',  'otherCount', 'processingCount', 'completedCount', 'pendingCount', 'cancelCount', 'visitors', 'days', 'totalSale', 'totalSaleCount', 'totalCustomerCount', 'productSoldCount', 'totalSaleGrowth', 'totalSaleCountGrowth', 'totalCustomerGrowth', 'productSoldGrowth'));
    }
    public function dashboardData($day, $type)
    {
        if ($type == 'total-sale') {
            $count = Order::where(
                'created_at',
                '>=',
                Carbon::now()->subDay($day)
            )->sum('total');

            $totalPrevSale = Order::whereBetween(
                'created_at',
                [Carbon::now()->subDay($day + $day), Carbon::now()->subDay($day)]
            )->sum('total');
            if (!$totalPrevSale) {
                $totalPrevSale = 1;
            }
            $growth = (($count - $totalPrevSale) / $totalPrevSale) * 100;
            $count = \App\Model\Product::currencyPriceRate($count);
        } else if ($type == 'sale-count') {
            $count = Order::where(
                'created_at',
                '>=',
                Carbon::now()->subDay($day)
            )->count();
            $totalPrevSale = Order::whereBetween(
                'created_at',
                [Carbon::now()->subDay($day + $day), Carbon::now()->subDay($day)]
            )->count();
            if (!$totalPrevSale) {
                $totalPrevSale = 1;
            }
            $growth = (($count - $totalPrevSale) / $totalPrevSale) * 100;
        } else if ($type == 'total-customer') {
            $count = User::where(
                'created_at',
                '>=',
                Carbon::now()->subDay($day)
            )->where('type', 0)->count();
            $totalPrevSale = User::whereBetween(
                'created_at',
                [Carbon::now()->subDay($day + $day), Carbon::now()->subDay($day)]
            )->where('type', 0)->count();
            if (!$totalPrevSale) {
                $totalPrevSale = 1;
            }
            $growth = (($count - $totalPrevSale) / $totalPrevSale) * 100;
        } else if ($type == 'product-sale') {
            $count = OrderProduct::where(
                'created_at',
                '>=',
                Carbon::now()->subDay($day)
            )->sum('qty');
            $totalPrevSale = OrderProduct::whereBetween(
                'created_at',
                [Carbon::now()->subDay($day + $day), Carbon::now()->subDay($day)]
            )->sum('qty');
            if (!$totalPrevSale) {
                $totalPrevSale = 1;
            }
            $growth = (($count - $totalPrevSale) / $totalPrevSale) * 100;
        }

        $data["count"] = $count;
        $data["class"] = $growth < 0 ? 'down-arrow ri-arrow-down-fill' : ' up-arrow ri-arrow-up-fill';
        $data["growth"] = round(abs($growth), 2) . "%";
        return response()->json($data);
    }
}
