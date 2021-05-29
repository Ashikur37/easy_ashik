<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Faq;
use App\Model\Page;
use App\Services\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function show($slug){
        $page=Page::whereSlug($slug)->firstOrFail();
        return view('front.page',compact('page'));
    }
    public function maintenance(){
        return view('front.maintenance');
    }
    public function faq()
    {
        $faqs=Faq::where('is_active',1)->get();

        return view('front.faq',compact('faqs'));
    }
    public function contact()
    {
        return view('front.contact'); 
    }
    public function submitContact(Request $request){
        $data=[
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "message"=>$request->message,

        ];
        Notification::contactSubmit($data);
        return back()->with('success','Message sent successfully');
    }
    public function aboutUs()
    {
        return view('front.about-us');
    }
    public function termsCondition()
    {
        Auth::logout();
        return view('front.terms-condition');
    }
}