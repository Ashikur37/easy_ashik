<?php
namespace App\Services;

use App\Model\Blog;
use App\Model\BlogCommentReply;
use App\Model\EmailSetting;
use App\Model\Order;
use App\Model\ProductCommentReply;
use App\Model\TicketMessage;
use App\Model\Withdraw;
use App\Notifications\Admin\BlogComment;
use App\Notifications\Admin\BlogCommentReply as BlogCommentReplyNotification;
use App\Notifications\Admin\ContactUsSubmit;
use App\Notifications\Admin\NewOrder;
use App\Notifications\Admin\NewTicket;
use App\Notifications\Admin\NewTicketMessage;
use App\Notifications\Admin\NewUserRegistration;
use App\Notifications\Admin\ProductCommentReply as ProductCommentReplyNotification;
use App\Notifications\Admin\ProductComment;
use App\Notifications\Admin\ProductReview;
use App\Notifications\Admin\UserWithdraw;
use App\Notifications\User\OrderSuccess;
use App\Notifications\User\OrderUpdate;
use App\Notifications\User\TicketReply;
use App\Notifications\User\UserAffiliation;
use App\Notifications\User\WithdrawUpdate;
use App\User;
use Config;

class Notification
{

    public function __construct() 
    {
        // $es = EmailSetting::first();
        // Config::set('mail.host', $es->smtp_host);
        // Config::set('mail.port', $es->smtp_port);
        // Config::set('mail.encryption', $es->mail_encryption);
        // Config::set('mail.username', $es->smtp_user);
        // Config::set('mail.password', $es->smtp_pass);  
    }
    static function contactSubmit($data){
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new ContactUsSubmit($data));
        }
    }
    static function adminBlogComment($id){
        
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new BlogComment($id));
        }
    }
    static function adminNewTicket($id){
        
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new NewTicket($id));
        }
    }
    static function userNewWithdraw($id){
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new UserWithdraw($id));
        }
    }
    static function adminNewTicketReply($id){
        
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new NewTicketMessage($id));
        }
    }
    static function newUser($id){
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new NewUserRegistration($id));
        }
    }
    static function adminProductComment($id){
        
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new ProductComment($id));
        }
    }
    static function adminProductReview($id){
        
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            $admin->notify(new ProductReview($id));
        }
    }
    static function adminBlogCommentReply($id){
        
        $blogComment=BlogCommentReply::find($id)->blogComment;
        $repliers=$blogComment->repliers;
        $repliers->push($blogComment->user);
        $currentReplier=BlogCommentReply::find($id)->user->id;
        foreach($repliers as $replier){
            if($replier->id!=$currentReplier){
                $replier->notify(new BlogCommentReplyNotification($id));
            }
        }
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
            if($admin->id!=$currentReplier){
                $admin->notify(new BlogCommentReplyNotification($id));
            }
        }
    }
    static function adminProductCommentReply($id){
        $productComment=ProductCommentReply::find($id)->productComment;
        $repliers=$productComment->repliers;
        $repliers->push($productComment->user);
        $currentReplier=ProductCommentReply::find($id)->user->id;
        foreach($repliers as $replier){
            if($replier->id!=$currentReplier){
                $replier->notify(new ProductCommentReplyNotification($id));
            }
        }
    }
    static function newOrderNotificationAdmin($id){
        $admins=User::whereType(3)->get();
        foreach($admins as $admin){
                $admin->notify(new NewOrder($id));
        }
    }
    static function newOrderNotificationUser($id){
        $order=Order::find($id);
        if($order->user){
            $order->user->notify(new OrderSuccess($id));
        }
    }
    static function orderUpdateUser($id){
        $order=Order::find($id);
        
        if($order->user){
            $order->user->notify(new OrderUpdate($id));
        }
    }
    static function userNewTicketReply($id){
        $ticketMessage=TicketMessage::find($id);
        $ticketMessage->ticket->user->notify(new TicketReply($id)); 
        
    }
    static function userWithdrawUpdate($id){
        $withdraw=Withdraw::find($id);
        $withdraw->user->notify(new WithdrawUpdate($id));
    }
    static function userAffiliation($id,$balance){
        $user=User::find($id);
        $user->notify(new UserAffiliation($balance));
    }
}