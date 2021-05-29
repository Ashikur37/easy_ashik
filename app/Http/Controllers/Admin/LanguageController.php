<?php

namespace App\Http\Controllers\Admin;

use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use App\Services\Word;
use Illuminate\Support\Facades\URL;
use Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $route="language";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Language','language');
            return $table->get()->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_active==1){
                    $checked="checked"; 
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/language/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            
            ->addColumn('action', function($row) use($user,$route){
                $btn='';
                if($user->can($route.'.edit')){
                    $btn.='<span class="ts-action-btn mr-2">
                    <a href="'.route($route.".edit",$row->id).'"><i class="ri-pencil-line"></i></a>
                </span> ';
                }
                
            if($user->can($route.'.destroy')){
                $btn.='<span class="ts-action-btn">
                <a class="delete-button" href="#" data-href="'.route($route.".destroy",$row->id).'"><i class="ri-delete-bin-line"></i></a>
            </span>';    
            }
                    return $btn;
            })->rawColumns(['action','index','status'])
            ->make(true);
      }
      
      
      
        return view('admin.language.index'); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $words=Word::list();
        return view('admin.language.create',compact('words')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {

        $data=Language::create([
            "name"=>$request->name,
            "is_active"=>$request->is_active?1:0,
            "file"=>time().Str::random(8).'.json'
        ]);
        $input = $request->all();
        unset($input['_token']);
        unset($input['name']);
        unset($input['is_active']); 
        unset($input['takwa-table_length']); 
        $def = file_get_contents(public_path().'/assets/lang/def.json');
        $def_words = json_decode($def);

        foreach($input as $word=>$val){
            if(!$val){
                if(isset($def_words->$word)){
                    $input[$word]=$def_words->$word;
                } 
            }
        }
        $mydata = json_encode($input);
        //def.json
        file_put_contents(public_path().'/assets/lang/'.$data->file, $mydata); 
        //--- Logic Section Ends

        return redirect()->route('language.index')->with('success',LanguageService::getTranslate('NewLanguageAdded'));     
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $words=Word::list();
        $data_results = file_get_contents(public_path().'/assets/lang/'.$language->file);
        $current_words = json_decode($data_results);
        return view('admin.language.edit',compact('words','language','current_words'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
       
        $file=$language->file;
        if (file_exists(public_path().'/assets/lang/'.$language->file)) {
            unlink(public_path().'/assets/lang/'.$language->file);
        }

        $language->update([
            "name"=>$request->name,
            "is_active"=>$request->is_active?1:0,
            "file"=>$file
        ]);
        $input = $request->all();
        unset($input['_token']);
        unset($input['_method']);
        unset($input['name']);
        unset($input['is_active']); 
            //takwa-table_length
        unset($input['takwa-table_length']); 
        $def = file_get_contents(public_path().'/assets/lang/def.json');
        $def_words = json_decode($def);

        foreach($input as $word=>$val){
            if(!$val){
                if(isset($def_words->$word)){
                    $input[$word]=$def_words->$word;
                    }
                }
        }
        $mydata = json_encode($input);
        file_put_contents(public_path().'/assets/lang/'.$language->file, $mydata); 

      
        return back()->with('success',LanguageService::getTranslate('LanguageUpdatedSuccessfully'));     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();
        return LanguageService::getTranslate("LanguageDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $language=Language::find($id);
            $language->delete();
        }
        return LanguageService::getTranslate("LanguageDeletedSuccessfully");
    }
    public function updateStatus(Language $language,$status){
        $language->update([
            "is_active"=>$status
        ]);
        return LanguageService::getTranslate("LanguageUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $language=Language::find($id);
            $language->update([
                "is_active"=>$status
            ]);
        }
        return LanguageService::getTranslate("LanguageUpdatedSuccessfully");
    }
}
