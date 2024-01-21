<?php

namespace Qubadoff\SimpleFirebasePushNotification;

trait SimpleFirebasePushNotification
{
    public function __construct(){}

    public function sendNotification($fmc_token, $title, $body): void
    {

        $data = array(
            'to' => $fmc_token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ]
        );

        $headers = array(
            'Authorization: key=' . env('FMC_SERVER_KEY'),
            'Content-Type: application/json',
        );

        $url= 'https://fcm.googleapis.com/fcm/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($data));
        curl_exec($ch);
        curl_close($ch);
    }
}