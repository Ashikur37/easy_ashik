<?php

namespace App\Http\Controllers\Api;

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
        if ($chat) {
            $chatMessages = ChatMessage::where('chat_id', $chat->id)->get();
            return new MessageCollection($chatMessages);
        } else {
            return [
                "data" => []
            ];
        }
    }
    public function getChat()
    {

        $chats = Chat::where('user_id', auth()->user()->id)->latest()->get();
        return new ChatCollection($chats);
    }
    public function sendMessage(Product $product, Request $request)
    {
        Log::debug($request->all());
        $chat = Chat::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        if (!$chat) {
            $chat = Chat::create([
                "user_id" => auth()->user()->id,
                "product_id" => $product->id,
                "merchant_id" => $product->user_id ? $product->user_id : 1,
                "subject" => $request->message
            ]);
        }
        return  ChatMessage::create([
            "chat_id" => $chat->id,
            "sender_id" => auth()->user()->id,
            "message" => $request->message,
        ]);
    }
}
