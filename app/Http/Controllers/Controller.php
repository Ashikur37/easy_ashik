<?php

namespace App\Http\Controllers;


use App\Model\SiteVisit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {

        if (!request()->ajax()) {
        $isNew=1;
        if(SiteVisit::whereIp(request()->ip())->first()){
            $isNew=0;
        }
        SiteVisit::create([
            "ip"=>request()->ip(),
            "url"=>request()->url(),
            "visit_date"=>date('Y-m-d'),
            "is_new"=>$isNew
        ]);
        }
       
    }
}
