<?php
   
namespace App\Http\Controllers;
   
use App\Http\Requests;
use Illuminate\Http\Request;
   
class DropZoneController extends Controller
{
   
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('dropzone-view');
    }
    
    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        //check admin
        if(!auth()->user()&&auth()->user()->type!=3){
            return; 
        }
        $path='';
        if($request->path){
            $path='/'.$request->path;
        }
        $image = $request->file('file');
   
        $imageName = rand(1,99).time().'.'.$image->extension();
        $image->move(public_path('images'.$path),$imageName);
   
        return response()->json(['name'=>$imageName]);
    }
    public function dropzoneRemove(Request $request){
        $path='/';
        if($request->path){
            $path='/'.$request->path.'/';
        }
        if (file_exists(public_path('images'.$path.$request->name) )){
            unlink(public_path('images'.$path.$request->name));
        }
        return "Successfully removed";
    }
   
}