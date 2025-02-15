<?php

namespace App\Commands;

use App\Application;

use App\Database\SQLite;

use App\EventSender\EventSender;

use App\Models\Event;
use App\Telegram\TelegramApiImpl;

//use App\Models\EventDto;

class HandleEventsCommand extends Command

{

    protected Application $app;

    public function __construct(Application $app)

    {

        $this->app = $app;

    }

    public function run(array $options = []): void

    {

        $event = new Event(new SQLite($this->app));

        $events = $event->select();

        $eventSender = new EventSender(new TelegramApiImpl($this->app->env('TELEGRAM_TOKEN')));

        foreach ($events as $event) {

            if ($this->shouldEventBeRan($event)) {
                // $eventSender->sendMessage($event->receiverId, $event->text);
                $eventSender->sendMessage($event['receiver_id'], $event['text']);

            }

        }

    }

    public function shouldEventBeRan(array $event): bool

    {
        $currentMinute = (int)date("i");

        $currentHour = (int)date("H");

        $currentDay = (int)date("d");

        $currentMonth = (int)date("m");

        $currentWeekday = (int)date("w");

        // return true;

        // return ($event['minute'] === $currentMinute &&

        //     $event['hour'] === $currentHour &&

        //     $event['day'] === $currentDay &&

        //     $event['month'] === $currentMonth &&

        //     $event['weekDay'] === $currentWeekday);

        return (($event['minute'] === $currentMinute || $event['minute'] === null) &&

            ($event['hour'] === $currentHour || $event['hour'] === null) &&

            ($event['day'] === $currentDay || $event['day'] === null) &&

            ($event['month'] === $currentMonth || $event['month'] === null) &&

            ($event['day_of_week'] === $currentWeekday || $event['day_of_week'] === null));
    }

}