<?php 

namespace App;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class SendCode{

    public static function sendCode($phone){
        $code =rand(1111,9999);
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key'    => 'OCAzAfgVbnVDnqDCaX3h8E4e',
            'consumer_secret' => '%PBztzXdvBs#ne78%Dk0baHJM8p)VdRUfZ2O@GJD',
            'token'           => '',
            'token_secret'    => ''
        ]);
        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://gatewayapi.com/rest/',
            'handler' => $stack,
            'auth'     => 'oauth'
        ]);
        
        $req = [
                'sender'     => 'Ecolectionz',
                'message'    => 'Your code is: '. $code,
                'recipients' => [['msisdn' => $phone]],
            ];
        // Set the "auth" request option to "oauth" to sign using oauth
        $client->post('mtsms', ['json' => $req]);
        return $code;
       /* $code =rand(1111,9999);
        $nexmo = app('Nexmo\Client');
            $nexmo->message()->send([
                'to' => '961'.(int) $phone,
                'from' => 'Nexmo',
                'text' => 'Verify Code '.$code
            ]);
            return $code;*/
    }
}