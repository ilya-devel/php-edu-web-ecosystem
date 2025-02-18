<?php

use PHPUnit\Framework\TestCase;

/**
 * @covers HandleEventsCommand
 * @group disableDeprecation
 */
class HandleEventsCommandTest extends TestCase {

    /**
     * @dataProvider eventDtoDataProvider
     */
    public function testShouldEventBeRanReceiveEventDtoAndReturnCorrectBool(array $event, bool $shouldEventBeRan):void {
        $handleEventCommand = new \App\Commands\HandleEventsCommand(new \App\Application(dirname(__DIR__)));
        $result = $handleEventCommand->shouldEventBeRan($event);
        self::assertEquals($result, $shouldEventBeRan);
    }

    public static function eventDtoDataProvider(): array {
        return [
            [
                [
                    'minute' => (int)date("i"),
                    'hour' => (int)date("H"),
                    'day' => (int)date("d"),
                    'month' => (int)date("m"),
                    'day_of_week' => (int)date("w")
                ],
                true
            ],
            [
                [
                    'minute' => (int)date("i"),
                    'hour' => (int)date("H"),
                    'day' => (int)date("d"),
                    'month' => (int)date("m"),
                    'day_of_week' => null
                ],
                true
            ]
        ];
    }
}