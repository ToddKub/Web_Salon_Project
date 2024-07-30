<?php

namespace App\Http\Controllers;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Middleware\Wit;

use Illuminate\Http\Request;

class chatbotController extends Controller
{
    public function handle(Request $request){
        $config = [
            //
        ];
        
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        
        // Create an instance
        $botman = BotManFactory::create($config,new LaravelCache());

        $wit = Wit::create(env('WIT_TOKEN'));
        $botman->middleware->received($wit);
        //Give the bot something to listen for.
        $botman->hears('{message}', function (BotMan $bot, $message) {
            $extras = $bot->getMessage()->getExtras();
            $entities = $extras['entities'];

            if (isset($entities['intent'])) {
                $intent = $entities['intent'][0]['value'];
                switch ($intent) {
                    case 'Greeting':
                        $bot->reply('Hello! How can I help you today?');
                        break;
                    case 'service':
                        $this->askService($bot);
                        break;
                    // เพิ่มกรณีเพิ่มเติมตามที่ต้องการ
                    default:
                        $bot->reply('Sorry, I did not understand that.');
                        break;
                }
            } else {
                $bot->reply('I did not get that. Can you say it again?');
            }
        });




        // Start listening
        $botman->listen();   
    }
    
    private function askService($bot)
    {
        // ข้อมูลบริการที่มี
        $services = [
            'บริการที่ 1',
            'บริการที่ 2',
            'บริการที่ 3',
            // เพิ่มบริการอื่นๆ ตามต้องการ
        ];
 
        $bot->reply('ดิฉันสามารถให้บริการดังต่อไปนี้ได้ค่ะ:');
 
        // แสดงรายการบริการ
        foreach ($services as $service) {
            $bot->reply($service);
        }
    }

}
