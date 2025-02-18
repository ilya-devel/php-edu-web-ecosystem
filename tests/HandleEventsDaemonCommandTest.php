<?php

use PHPUnit\Framework\TestCase;

/**
 * @covers HandleEventsDaemonCommand
 * @group disableDeprecation
 */
class HandleEventsDaemonCommandTest extends TestCase {
    public function testGetCurrentTime(){
        $saveEventCommand = new \App\Commands\HandleEventsDaemonCommand(new \App\Application(dirname(__DIR__)));
        self::assertEquals($saveEventCommand->getCurrentTime(), [
            date("i"),
            date("H"),
            date("d"),
            date("m"),
            date("w")
        ]);
    }
}