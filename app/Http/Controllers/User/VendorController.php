<?php  
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\Vendor;
use App\Services\LanguageService;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    public function applyVendor(){
        if(Vendor::where('user_id',auth()->user()->id)->first()){
        return back()->with('error','Application already submitted');

        }
        return view('user.vendor.index');
    }
    public function submitVendor(Request $request){
       $vendor= Vendor::create($request->all());
       $vendor->user_id=auth()->user()->id;
       $vendor->save();
        return redirect('/user')->with('success','Vendor application submitted');
    }

}