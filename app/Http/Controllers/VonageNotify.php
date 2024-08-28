<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VonageNotify extends Controller
{
    public function send(){

        $basic  = new \Vonage\Client\Credentials\Basic("6ed780eb", "7EQGEftQtyixCj9p");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("639652086326", 'test title', 'Hello this is from KIBAWE OPD HOSPITAL friday nov 24')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return "The message was sent successfully\n";
        } else {
            return "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
