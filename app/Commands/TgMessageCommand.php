<?php

namespace App\Commands;

use App\Application;
use App\Telegram\TelegramApiImpl;

class TgMessageCommand extends Command {
    public function __construct(public Application $application){
        $this->app = $application;
    }

    public function run(array $options = []):void{
        $tgApi = new TelegramApiImpl($this->app->env('TELEGRAM_TOKEN'));
        echo json_encode($tgApi->getMessages(0));
    }
}