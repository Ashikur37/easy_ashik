<?php

namespace App\Http\Controllers\Admin;

use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Services\Datatable;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('Tag','tag');
            return $table->getAll();
      }
      
        return view('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {

        foreach($request->name as $name){
            Tag::create([
                'name' => $name
            ]);
        }

       return redirect()->route('tag.index')->with('success','TagCreatedSuccessfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',compact('tag'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
       $tag->update([
            'name' => $request->name
        ]);

       return redirect()->route('tag.index')->with('success','TagUpdatedSuccessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return "TagDeletedSuccessfully";
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $tag=Tag::find($id);
            $tag->delete();
        }
        return "TagDeletedSuccessfully";
    }
}
