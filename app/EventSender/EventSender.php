<?php
namespace App\EventSender;

use App\Telegram\TelegramApi;
use App\Queue\Queue;
use App\Queue\Queueable;

class EventSender implements Queueable
{
    private string $receiver;
    private string $message;
    private TelegramApi $telegramApi;
    private Queue $queue;

    public function __construct(
        TelegramApi $telegramApi,
        Queue $queue
    ) {
        $this->telegramApi = $telegramApi;
        $this->queue = $queue;
    }
    public function sendMessage(string $receiver, string $message){
        $this->toQueue($receiver, $message);
    }

    public function handle(): void {
        // var_dump(4444, $this->receiver, $this->message);
        $this->telegramApi->sendMessage($this->receiver, $this->message);
    }

    public function toQueue(...$args): void {
        $this->receiver = $args[0];
        $this->message = $args[1];

        $this->queue->sendMessage(serialize($this));
    }

    // public function sendMessage(string $receiver, string $message)
    // {
    // $this->telegramApi->sendMessage($receiver, $message);
    //     // echo date('d.m.y H:i') . " Я отправил сообщение $message получателю с id $receiver\n";
    // }
}