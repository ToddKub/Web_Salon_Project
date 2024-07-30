<?php

require 'vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\DoctrineCache;
use Doctrine\Common\Cache\FilesystemCache;
use BotMan\BotMan\Middleware\ApiAi;

// Setup BotMan
$config = [
    'conversation_cache_time' => 30
];

// Create an instance of the BotMan class
$botman = BotManFactory::create($config);

// Set up middleware for API.ai
$dialogflow = ApiAi::create('YOUR_API_AI_CLIENT_ACCESS_TOKEN')->listenForAction();

$botman->middleware->received($dialogflow);

// Define botman commands and responses
$botman->hears('Hello', function (BotMan $bot) {
    $bot->reply('Hi! How can I help you today?');
});

// Start the bot
$botman->listen();