<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Review;

class ReviewController extends Controller
{
    public function index()
    {   $reviews=Review::where('reviewer_id',auth()->user()->id)->with('product')->paginate(10);

        return view('user.review.index',compact('reviews'));
    }
    public function removeItem(){
        $id=request()->id;
        Review::find($id)->delete();
        return 1;
    } 
}
