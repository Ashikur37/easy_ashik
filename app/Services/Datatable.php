<?php
namespace App\Services;
use DataTables;
use Illuminate\Support\Facades\URL;

class Datatable
{
    public $model,$route,$with,$edit,$delete;
    
    function __construct($model,$route,$with=null,$status=null,$edit=true,$delete=true) {
        $this->model = 'App\\Model\\'.$model;
        $this->route = $route;
        $this->with = $with;
        $this->status = $status;
        $this->edit = $edit;
        $this->delete = $delete;
    }
    function get($columns=false){
        $user=auth()->user();
        $route=$this->route;
        if($this->with){
            $data = $this->model::with($this->with)->latest();
        }
        else{
            $data = $this->model::latest();
        }
        if($columns){
            $data =$data->get($columns);
        }
        else{
            $data =$data->get();
        }
            return Datatables::of($data);
                    
    }
    function getFromData($data){
            return Datatables::of($data);
                    
    }
    function getAll(){
        $user=auth()->user();
        $route=$this->route;
        if($this->with){
            $data = $this->model::with($this->with)->latest()->get();
        }
        else{
            $data = $this->model::latest()->get();
        }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('index', function($row){
                        return '<div class="icheck-primary d-inline">
                        <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                        <label for="checkboxPrimary'.$row->id.'">
                        </label>
                      </div>';

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
                    })
                    ->rawColumns(['action','index'])
                    ->make(true);
    }
    function getAllWithStatus(){
        $user=auth()->user();
        $route=$this->route;
        $edit=$this->edit;
        $delete=$this->delete;
        if($this->with){
            $data = $this->model::with($this->with)->latest()->get();
        }
        else{
            $data = $this->model::latest()->get();
        }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('index', function($row){
                        return '<div class="icheck-primary d-inline">
                        <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                        <label for="checkboxPrimary'.$row->id.'">
                        </label>
                      </div>';

                    })
                    ->editColumn('created_at',function ($row){
                        return $row->created_at->diffForHumans();;
                    })
                    ->editColumn($this->status,function($row)use($route){
                        $checked="";
                        if($row[$this->status]==1){
                            $checked="checked";
                        }
                        return '<label class="ts-swich-label d-inline">
                        <input data-href="'.URL::to('admin/'.$route.'/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                        <span class="ts-swich-body"></span>
                      </label>';
                    })
                    ->addColumn('action', function($row) use($user,$route,$edit,$delete){
                        $btn='';
                        if($user->can($route.'.edit')&&$edit){
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
                    })
                    ->rawColumns(['action','index',$this->status])
                    ->make(true);
    }
    function getAllByData($data){
        $user=auth()->user();
        $route=$this->route;
        
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('index', function($row){
                        return '<div class="icheck-primary d-inline">
                        <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                        <label for="checkboxPrimary'.$row->id.'">
                        </label>
                      </div>';

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
                    })
                    ->rawColumns(['action','index'])
                    ->make(true);
    }
}