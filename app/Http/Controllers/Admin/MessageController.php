<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Chat;
use App\Events\MessageCenter;
use App\Events\ProductOrder;
use App\Http\Resources\MerchantMessageResource;
use App\Http\Resources\MerchantMessagesResource;
use App\Http\Resources\SupplierMessageResource;
use App\Http\Resources\UserSessionResource;
use App\MerchantAssistanceMessage;
use App\MerchantSupplierMessage;
use App\Message;
use App\Notifications\BuyerWantToContact;
use App\Notifications\BuyerWantToContactFromProduct;
use App\Notifications\RfqBidNotification;
use App\Models\User;
use App\UserSession;
use App\Userchat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\RfqMerchantAssistanceMessage;
use App\Http\Resources\RfqMerchantMessagesResource;
use App\Http\Resources\RfqMerchantMessageResource;
use App\Models\Rfq;
use App\Models\BusinessProfile;

class MessageController extends Controller
{
    public function getchatdata(Request $request)
    {
        $user = $request->user??"5552";
        $to_id = $request->to_id??"3";
        $from_user=User::find($user);
        // dd($from_user);
        $to_user=User::find($to_id);
        // dd($to_user);
        $from_user_image= isset($from_user->image) ? asset('storage').'/'.$from_user->image : asset('storage/images/supplier.png');
        $to_user_image= isset($to_user->image) ? asset('storage').'/'.$to_user->image : asset('storage/images/supplier.png');
        $chats = Userchat::where('participates', $user)->where('participates', $to_id);
        if($chats->exists()){
            $chat = $chats->first();
            $chatdataAllData = $chat->chatdata;
            $chatdata = $chatdataAllData;
            foreach ($chatdataAllData as $key => $value) {
                $messageStr = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $value['message']);
                $chatdata[$key]['message'] = $messageStr;
            }
            return response()->json([
                'success' => false,
                'msg'     => 'Message sends successfully',
                'chatdata'    => $chatdata,
                'from_user_image'=>$from_user_image,
                'to_user_image'=>$to_user_image,
                'about_company'=>$about_company
            ],200);
        }
        else{
            $chatdata = [];
            return response()->json([
                'success' => false,
                'msg'     => 'Message sends successfully',
                'chatdata'    => $chatdata,
                'from_user_image'=>$from_user_image,
                'to_user_image'=>$to_user_image,
                'about_company'=>$about_company
            ],200);
        }
    }
}
