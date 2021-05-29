<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TicketCategoryRequest;
use App\Model\TicketCategory;
use App\Services\Datatable;
use App\Services\LanguageService;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('TicketCategory','ticket-category');
            return $table->getAll();
      }
      
        return view('admin.ticket-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket-category.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCategoryRequest $request)
    {
        TicketCategory::create([
            'name' => $request->name
        ]);

       return redirect()->route('ticket-category.index')->with('success',LanguageService::getTranslate('TicketCategoryCreatedSuccessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketCategory $ticketCategory)
    {
        return view('admin.ticket-category.edit',compact('ticketCategory'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
       $ticketCategory->update([
            'name' => $request->name
        ]);

       return redirect()->route('ticket-category.index')->with('success',LanguageService::getTranslate('TicketCategoryUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
        return LanguageService::getTranslate("TicketCategoryDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $ticketCategory=TicketCategory::find($id);
            $ticketCategory->delete();
        }
        return LanguageService::getTranslate("TicketCategoryDeletedSuccessfully");
    }
}
