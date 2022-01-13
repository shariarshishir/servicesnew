<?php

namespace App\Http\Traits;

trait PushNotificationTrait {

        public  function pushNotificationSend($fcmToken,$userName,$message){
            define('API_ACCESS_KEY','AAAAaiBrIq0:APA91bF4mv49Tnd3KHaHQ3Y77EwR1AfB2JloyI1AnQuPO5P7ToKXrm8xVT8UbjaTfJLKBKVZH4UjrPoFUuMs5shDMtLXZ7zkv6JYcwv9tQ_srjfs9xOhzUx-wd_4tBEzH-T_p7GFs99X');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
            $notification = [
            //write title, description and so on
            'title'		=> 'Hello '.$userName,
            'body' 	=> $message,
            'sound' =>'fcmsound.mp3'
            ];

            $extraNotificationData = [
            'body' 	=> 'You have a new percel order.Please check in your dashboard.',
            'message' 	=> 'here is a message. message',
            ];
                
            $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        =>$fcmToken, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
            ];
            $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
            $aa =  $result;

    }
}