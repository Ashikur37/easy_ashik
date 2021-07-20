<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Currency;
use App\Model\Language;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Slide;
use App\Model\SubCategory;
use App\Model\Subscriber;
use App\User;
use Illuminate\Support\Facades\Session;
use Cart;
use View;
use Cache;

class HomeController extends Controller
{

    public function index()
    {
        if (request()->user) {
            $user = User::where('affiliate_link', request()->user)->first();
            if ($user) {
                Session::put("affiliator", $user->id);
            }
            return redirect('/');
        }

        $flashSale = Cache::get('flashSale');

        $slides = Slide::whereStatus(1)->get();
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }

        $globalStyle = false;
        return view('front.home', compact('cartProducts', 'flashSale', 'slides', 'globalStyle'));
    }

    // LANGUAGE SECTION

    public function loadMore()
    {
        $topTrendProducts = Product::where('is_top', 1)->where('is_active', 1)->get();
        $hotProducts = Product::where('is_hot', 1)->where('is_active', 1)->get();
        $trendingProducts = Product::where('is_trending', 1)->where('is_active', 1)->get();
        $bestDealProducts = Product::where('best_deal', 1)->where('is_active', 1)->take(5)->get();
        $bestSellProducts = OrderProduct::groupBy('product_id')->selectRaw('sum(order_products.qty) as product_count,product_id')
            ->with('product')
            ->orderBy('product_count', 'desc')->limit(4)->get();
        $blogs = Blog::where('show', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $brands = Brand::whereStatus(1)->orderBy('name')->get();
        $newProducts = Product::where('is_offer', 0)->latest()->limit(4)->get();

        $trendCategories = Category::get()->sortByDesc('product_view')->take(6);
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('front.homeExtra', compact('cartProducts', 'topTrendProducts', 'hotProducts', 'trendingProducts', 'bestDealProducts', 'bestSellProducts', 'brands', 'blogs', 'trendCategories', 'newProducts'));
    }
    public function language($id)
    {
        Session::put('language', Language::find($id));
        return redirect()->back();
    }

    // LANGUAGE SECTION ENDS

    public function loadHeader()
    {
        //cart header for large device
        $lgCart = (string)View::make('load.front.header');
        //cart header for Small device
        $smCart = (string)View::make('load.front.sm-cart');
        //cart,wishlist,compare list counter
        $smHeader = (string)View::make('load.front.sm-header');
        return [
            "lgCart" => $lgCart,
            "smCart" => $smCart,
            "smHeader" => $smHeader
        ];
    }
    public function loadAsideCart()
    {
        $items = Cart::content();
        return view('includes.front.cart', compact('items'));
    }
    public function loadSubProduct(SubCategory $subCategory)
    {
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('includes.front.subProduct', compact('cartProducts', 'subCategory'));
    }
    public function loadQuick(Product $product)
    {
        $items = Cart::instance('compare-list')->content();

        $inCompareList = false;
        foreach ($items as $item) {
            if ($item->id == $product->id) {
                $inCompareList = true;
            }
        }
        $rating = floor($product->reviews->avg('rating'));
        return view('load.front.quick-view', compact('product', 'rating', 'inCompareList'));
    }
    public function currency($id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', Currency::find($id));
        return redirect()->back();
    }

    public function suggestSearch($key)
    {

        if (!$key) {
            $products = [];
        } else if (request()->category) {
            $category_id = Category::whereSlug(request()->category)->first()->id;
            $count = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $key . '%')->where('is_active', 1)->count();
            $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $key . '%')->where('is_active', 1)->orderBy('name')->limit(5)->get();
        } else {
            $count = Product::where('name', 'like', '%' . $key . '%')->where('is_active', 1)->count();
            $products = Product::where('name', 'like', '%' . $key . '%')->where('is_active', 1)->orderBy('name')->limit(5)->get();
        }
        return view('load.front.suggestion', compact('products', 'key', 'count'));
    }

    public function loadTrendingProducts(Category $category)
    {
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.trending-product', compact('category', 'cartProducts'));
    }
    public function subscribe($email)
    {
        if (Subscriber::whereEmail($email)->first()) {
            return "Already subscribed";
        }
        Subscriber::create([
            'email' => $email,
            'ip' => request()->ip(),
            'last_email' => '',
        ]);
        return "Subscribed successfully";
    }
    public function unsubscribe($email)
    {
        $subscriber = Subscriber::whereEmail($email)->firstOrFail();
        $subscriber->delete();
    }
}
