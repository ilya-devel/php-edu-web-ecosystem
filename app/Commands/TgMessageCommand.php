<?php

namespace App\Commands;

use App\Application;
use App\Telegram\TelegramApiImpl;
use App\Actions\EventSaver;
use App\Actions\EventSender;
use App\Database\SQLite;
use App\Models\Event;

class TgMessageCommand extends Command {
    public function __construct(public Application $application){
        $this->app = $application;
    }

    public function run(array $options = []):void{
        $tgApi = new TelegramApiImpl($this->app->env('TELEGRAM_TOKEN'));
        echo json_encode($tgApi->getMessages(0));
        // $eventSender = new EventSender(new TelegramApiImpl($this->app->env('TELEGRAM_TOKEN')));

        // $eventModel = new Event(new SQLite($this->app));
        // $eventSaver = new EventSaver($eventModel);

        // // $thEvents = new TgEvents()
        // while (true) {
        //     $tgEvents->handle();
        //     sleep();
        // }
    }
}