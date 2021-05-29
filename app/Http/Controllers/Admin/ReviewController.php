<?php

namespace App\Http\Controllers\Admin;

use App\Model\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Services\Datatable;
use App\Services\LanguageService;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('Review','review',['user','product'],'is_approved',false,true);
            return $table->getAllWithStatus();
      }
      
        return view('admin.review.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.review.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        Review::create([
            'name' => $request->name
        ]);

       return redirect()->route('review.index')->with('success','Review created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('admin.review.edit',compact('review'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
       $review->update([
            'name' => $request->name
        ]);

       return redirect()->route('review.index')->with('success',LanguageService::getTranslate('ReviewUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return LanguageService::getTranslate("ReviewDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $review=Review::find($id);
            $review->delete();
        }
        return LanguageService::getTranslate("ReviewDeletedSuccessfully");
    }
    public function updateStatus(Review $review,$status){
        $review->update([
            "is_approved"=>$status
        ]);
        $review->product->update([
            "rating"=>$review->product->reviews->where('is_approved',1)->avg->rating
        ]);
        return LanguageService::getTranslate("ReviewUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $review=Review::find($id);
            $review->update([
                "is_approved"=>$status
            ]);
            $review->product->update([
                "rating"=>$review->product->reviews->where('is_approved',1)->avg->rating
            ]);
        }
        return LanguageService::getTranslate("ReviewUpdatedSuccessfully");
    }
}
