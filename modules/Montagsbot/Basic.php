<?php
namespace Telegram\Montagsbot;

use Sofa\HttpClient\Factory;
use GuzzleHttp\RequestOptions;


//  formapro /telegram-bot-php 

class Basic
{

    protected $client = null;
    protected $token = null;

    public function __construct()
    {
        // register factory in IoC with default app logger
        app()->bind(Factory::class, fn () => new Factory(app()->environment('testing'), app('log')));
        $this->token = config('app.token');
        // then inject or resolve wherever you need
        $this->client = app(Factory::class)
        ->withOptions(['base_uri' => 'https://api.telegram.org'])
        ->enableRetries()
        ->enableLogging()
        ->make();
    }

    /**
     * 
     */
    public function sendMessage(int $chat_id=null, string $text=null)
    {
        // preset values if null
        if (!($chat_id  && $text)) 
        {
            $chat_id = 778507913;
            $text    = "Preset - Test-Text";
        }

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Testschaltfläche', 'callback_data' => '1']
                ]
            ]
        ];
        $param = array(
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => $keyboard
        );
       // $response = $this->client->get("/bot{$this->token}/sendMessage?chat_id=778507913&text=dies ist ein text");
       $response = $this->client->post("/bot{$this->token}/sendMessage", [
            RequestOptions::JSON => $param // or 'json' => [...]
        ]);
        //dd($response);

    }
    
    /**
     */

    public function getMe():void
    {
        $response = $this->client->get("/bot{$this->token}/getMe");
        $text = $response->getBody()->read(10000);
        //var_dump($text);
   
    }

    public function getUpdates():void
    {
        $response = $this->client->get("/bot{$this->token}/getUpdates");
        $text = $response->getBody()->read(100000);
        //var_dump($text);
   
    }
}