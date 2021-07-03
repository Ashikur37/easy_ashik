<?php

namespace App\Services;

use App\Model\EmailSetting;
use App\Model\Subscriber;
use Mail;

class MailService
{
    public static function sendToMany($emails, $subject, $body)
    {
        $setup = EmailSetting::find(1);
        $data = [
            'email_body' => $body
        ];
        foreach ($emails as $email) {

            $objDemo = new \stdClass();
            $objDemo->to = $email->email;
            $objDemo->from = $setup->from_email;
            $objDemo->title = $setup->from_name;
            $objDemo->subject = $subject;

            try {
                Mail::send('mail.body', $data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from, $objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            } catch (\Exception $e) {
            }
        }
    }
    public static function singleSms($msisdn, $messageBody, $csmsId)
    {
        $params = [
            "api_token" => "easymert-35405327-b328-4903-8393-4533f0cef537",
            "sid" => "EASYMERTAPI",
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = trim("https://smsplus.sslwireless.com", '/') . "/api/v3/send-sms";
        $params = json_encode($params);

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
    function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public static function sendToManySubscriber($subject, $body)
    {
        $setup = EmailSetting::find(1);
        $subscribers = Subscriber::all();
        $data = [
            'email_body' => $body
        ];
        foreach ($subscribers as $subscriber) {
            $subscriber->mail_count += 1;
            $subscriber->last_email = $subject;
            $subscriber->save();
            $objDemo = new \stdClass();
            $objDemo->to = $subscriber->email;
            $objDemo->from = $setup->from_email;
            $objDemo->title = $setup->from_name;
            $objDemo->subject = $subject;

            try {
                Mail::send('mail.body', $data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from, $objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            } catch (\Exception $e) {
                dd($e);
            }
        }
    }
}
