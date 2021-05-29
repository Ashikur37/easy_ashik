<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\Ticket;
use App\Model\TicketCategory;
use App\Model\TicketMessage;
use App\Services\LanguageService;
use App\Services\Notification;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        $tickets=Ticket::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(10);
        $ticketCategories=TicketCategory::all();
        return view('user.ticket.index',compact('tickets','ticketCategories'));
    }
    public function loadTicket(Ticket $ticket){
        $messages=TicketMessage::where('ticket_id',$ticket->id)->orderBy('created_at','desc')->get();
        return view('load.user.ticket',compact('ticket','messages')); 
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
            "sender_type"=>0,
            "seen"=>0,
            "attachment"=>$attachment
        ]);
        Notification::adminNewTicketReply($message->id);
        $messages=TicketMessage::where('ticket_id',$ticket->id)->orderBy('created_at','desc')->get();
        return view('load.user.ticket',compact('ticket','messages'));
    }
    public function store(Request $request){
        $ticket=Ticket::create([
            "ticket_category_id"=>$request->ticket_category_id,
            "subject"=>$request->subject,
            "user_id"=>auth()->user()->id,
            "status"=>1
        ]);
        // Notification::newMerchantTicket($ticket->id);
        $ticket->messages()->create([
            "message"=>$request->message,
            "sender_id"=>auth()->user()->id,
            "sender_type"=>0,
            "seen"=>0
        ]);
        Notification::adminNewTicket($ticket->id);
        return redirect()->route('user.ticket')->with('success',LanguageService::getTranslate('TicketCreatedSuccessfully'));
    }
}
