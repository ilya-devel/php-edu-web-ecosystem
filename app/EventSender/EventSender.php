<?php
namespace App\EventSender;

use App\Telegram\TelegramApi;

class EventSender
{
    private TelegramApi $telegramApi;
    public function __construct(TelegramApi $telegramApi) {
        $this->telegramApi = $telegramApi;
    }

    public function sendMessage(string $receiver, string $message)
    {
    $this->telegramApi->sendMessage($receiver, $message);
        // echo date('d.m.y H:i') . " Я отправил сообщение $message получателю с id $receiver\n";
    }
}