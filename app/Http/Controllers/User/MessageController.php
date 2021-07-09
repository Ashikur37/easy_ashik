<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\ProductCollection;
use App\Model\Campaign;
use App\Model\Chat;
use App\Model\ChatMessage;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{


    public function getMessages(Product $product)
    {
        $chat = Chat::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();

        $messages = ChatMessage::where('chat_id', $chat->id)->get();
        return view('load.user.chat', compact('messages', 'product'));
    }
    public function getChat()
    {

        $chats = Chat::where('user_id', auth()->user()->id)->latest()->get();
        return new ChatCollection($chats);
    }
    public function sendMessage(Product $product, Request $request)
    {


        $chat = Chat::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        if (!$chat) {
            $chat = Chat::create([
                "user_id" => auth()->user()->id,
                "product_id" => $product->id,
                "merchant_id" => $product->user_id ? $product->user_id : 1,
                "subject" => $request->message
            ]);
        }
        $chat = Chat::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        ChatMessage::create([
            "chat_id" => $chat->id,
            "sender_id" => auth()->user()->id,
            "message" => $request->message,
        ]);
        $messages = ChatMessage::where('chat_id', $chat->id)->get();

        return view('load.user.chat', compact('messages', 'product'));
    }
}
