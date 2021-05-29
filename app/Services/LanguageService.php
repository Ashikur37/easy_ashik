<?php
namespace App\Services;

use App\Model\Language;
use DB;
use Session;

class LanguageService{

    public static function getTranslate($key){
            $data = Session::get('language'); 
            if(!$data){
                return $key;
            }
            $data_results = file_get_contents(public_path().'/assets/lang/'.$data->file);
            $lang = json_decode($data_results);
            return $lang->$key;
    }
}