<?php

namespace App\Http\Controllers\Admin;

use App\Model\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Model\EmailSetting;
use App\Model\TicketMessage;
use App\Services\LanguageService;
use App\Services\Notification;
use Config;
use Illuminate\Support\Facades\URL;
use DataTables;
use Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="ticket";
        $user=auth()->user();
        if (request()->ajax()) {
             $data= Ticket::orderBy('created_at','desc')->get();
             
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('index', function($row){
                            return '<div class="icheck-primary d-inline">
                            <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                            <label for="checkboxPrimary'.$row->id.'">
                            </label>
                          </div>';
            
                        })
                         ->addColumn('last_message', function($row) {
                            return $row->messages->last()->message."<br><span  class='text text-mute'>
                            ".$row->messages->last()->created_at->diffForHumans()."<span>";
                         })
                         ->addColumn('user', function($row) {
                            return $row->user->name;
                         })
                         ->editColumn('status',function($row){
                            $checked="";
                            if($row->status==1){
                                $checked="checked";
                            }
                            return '<label class="ts-swich-label d-inline">
                            <input data-href="'.URL::to('admin/ticket/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                            <span class="ts-swich-body"></span>
                          </label>';
                        })
                         ->editColumn('created_at',function($row){
                            return $row->created_at->diffForHumans();
                         })
                         ->addColumn('action', function($row)use($user,$route) {
                            $btn='';
                            if($user->can($route.'.edit')){
                                $btn.='<span data-id="'.$row->id.'"style="margin-right:5px;cursor:pointer" class="show-chat-btn btn-view">
                                <i class="ri-eye-line"></i>
                            </span>';
                            }
                            return $btn;
                         })
                         ->rawColumns(['action','index','last_message','status'])
                         ->make(true);
      }
      
        return view('admin.ticket.index');
    }

    public function loadTicket(Ticket $ticket){
        $messages=TicketMessage::where('ticket_id',$ticket->id)->orderBy('created_at','desc')->get();
        return view('load.admin.ticket',compact('ticket','messages')); 
    }
    public function postMessage(Request $request,Ticket $ticket){
        $attachment="";
        if($request->attachment&&in_array($request->attachment->extension(),["jpg","jpeg","png","pdf","gif","doc","docx","txt"])){
            $attachment = auth()->user()->id.time().'.'.$request->attachment->extension();  
            $request->attachment->move(public_path('images/ticket'), $attachment);
        }   
        $message=$ticket->messages()->create([
            "message"=>$request->message,
            "sender_id"=>auth()->user()->id,
            "sender_type"=>1,
            "seen"=>0,
            "attachment"=>$attachment
        ]);
        Notification::userNewTicketReply($message->id);
        $messages=TicketMessage::where('ticket_id',$ticket->id)->orderBy('created_at','desc')->get();
        return view('load.admin.ticket',compact('ticket','messages'));
    }

    public function updateStatus(TICKET $ticket,$status){
        $ticket->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("TicketUpdatedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $ticket=Ticket::find($id);
            $ticket->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("TicketUpdatedSuccessfully");
    }
}
