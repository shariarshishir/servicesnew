<?php

namespace App\Http\Traits;

trait PushNotificationTrait {

        public  function pushNotificationSend($fcmToken,$title,$message){
           // define('API_ACCESS_KEY','AAAAt8CxkOs:APA91bFDPXCdGn-N7U1_u1XjtIi3WRz76RxAdjp7wE8CgXzhKQcKcOWiMKx2KBAwneCue_TuUuvD83ZqGWkqHVqbFp_Khgm3xiL2lsMuuBaIgK_PsPis9WAhrziLJC0TkQZVzxRaBD-2');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            
            $notification = [
            //write title, description and so on
            'title'		=> $title,
            'body' 	=> $message,
            'sound' =>'fcmsound.mp3',
            'icon'=>'launcher_icon',
            'alert' => true,
            'channelId'=>'merchantbay'
            ];

            $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        =>$fcmToken, //single token
            'priority' =>'high',
            'sound'=>'default',
            'notification' => $notification,
            'click_action'=>env('APP_URL'),
            ];
            $headers = [
            'Authorization: key=' . env('API_ACCESS_KEY'),
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