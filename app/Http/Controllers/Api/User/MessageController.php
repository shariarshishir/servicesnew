<?php

namespace App\Http\Controllers\API\USER;

use App\Userchat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use stdClass;

class MessageController extends Controller
{

    public function message_center(){

        $user=Auth::user();

        $chatdatas = Userchat::all();
        $chatusers = [];
        if(request()->business_id){
            $selectBusinessId=request()->business_id;
            $type='business';
            $chat_user_id = [];
            foreach($chatdatas as $chat)
            {
                if($selectBusinessId == $chat->participates['business_id'])
                {
                    $chat_user_id[] = $chat->participates['user_id'];
                }
            }
            $chat_user_list=User::whereIn('id', $chat_user_id)->orderBy('last_activity', 'DESC')->get();
            foreach( $chat_user_list as $list){
                array_push( $chatusers, ['business_id' => $selectBusinessId,'user_id'=>$list->id,'name' => $list->name, 'image' => $list->image? asset('storage/'.$list->image) : asset('storage/images/supplier.png')]);

            }
        }else{
            $type='buyer';
            $business_id = [];
            foreach($chatdatas as $chat)
            {
                if($user->id == $chat->participates['user_id'])
                {
                    $business_id[] = $chat->participates['business_id'];
                }
            }
            $business_profile=BusinessProfile::whereIn('id', $business_id)->get()->sortByDesc(function($query){
                return $query->user->last_activity;
             })->all();
            foreach($business_profile as $list){
                array_push( $chatusers, ['business_id'=>$list->id,'name' => $list->business_name, 'image' => $list->user->image? asset('storage/'.$list->user->image) : asset('storage/images/supplier.png')]);

            }
        }


        $user_business_id=[];
        if($user->businessProfile()->exists()){
            foreach($user->businessProfile as $profile){
                array_push($user_business_id, $profile->id);
            }
        }
        if($user->businessProfileForRepresentative()->exists()){
            array_push($user_business_id, $user->businessProfileForRepresentative->id);
        }
        $user_business_profile=BusinessProfile::whereIn('id', $user_business_id)->get();

        $user_data=new stdClass();
        $user_data->id=$user->id;
        $user_data->sso_reference_id= $user->sso_reference_id;
        $user_data->name=$user->name;
        $user_data->email= $user->email;
        $user_data->phone=$user->phone;
        $user_data->image= $user->image;
        $user_data->fcm_token=$user->fcm_token;
        $user_data->last_activity= $user->last_activity;
        $user_data->is_representative= $user->is_representative;

        return response()->json([
            'user' => $user_data,
            'chatusers' => $chatusers,
            'user_business_profile' => $user_business_profile,
            'type' => $type,
            'status'   => true,
        ],200);

    }

    public function getchatdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'business_id'   => 'required',

         ]);
         if ($validator->fails())
         {
             return response()->json(array(
             'success' => false,
             'error' => $validator->getMessageBag()),
             400);
         }
        try{
            $user_id = $request->user_id;
            $business_id = $request->business_id;
            $user=User::find($user_id);
            $business=BusinessProfile::find($business_id);

            $user_business_id=[];
            if(auth()->user()->businessProfile()->exists()){
                foreach(auth()->user()->businessProfile as $profile){
                    array_push($user_business_id, $profile->id);
                }
            }
            if(auth()->user()->businessProfileForRepresentative()->exists()){
                array_push($user_business_id, auth()->user()->businessProfileForRepresentative->id);
            }

            $user_image= isset($user->image) ? asset('storage').'/'.$user->image : asset('storage/images/supplier.png');
            $business_image= isset($business->user->image) ? asset('storage').'/'.$business->user->image : asset('storage/images/supplier.png');
            $chats = Userchat::whereIn('participates.user_id', [$user_id])->whereIn('participates.business_id', [$business_id]);
            if($chats->exists())
            {
                $chat = $chats->first();
                $chatdataAllData = $chat->chatdata;
                $chatdata = $chatdataAllData;
                foreach ($chatdataAllData as $key => $value) {
                    $messageStr = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $value['message']);
                    $chatdata[$key]['message'] = $messageStr;
                }

                return response()->json([
                    "user"=>$user,
                    "chatdata"=>$chatdata,
                    "user_image"=>$user_image,
                    "business_image" => $business_image,
                    // "user_business_id" => $user_business_id,
                    "success"=>true], 200);
            }
            else
            {
                $chatdata = [];
                return response()->json(["chatdata"=>$chatdata, "success"=>false], 200);
            }

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response([
                'status' => false,
                'error' => 'user not found'
            ], 404);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['msg' => $e->getMessage()],
            ],500);

        }


    }



}
