<?php
require './../src/Timer/Timer.php';

const FAIL = 'Fail' . PHP_EOL;
const PASS = 'OK' . PHP_EOL . PHP_EOL;

use markuszeller\Timer\Timer;

class TestTimer extends Timer {
    public function setSeconds(int $seconds): void {
        $this->stop();
        $this->endTime = $this->startTime + $seconds;
        $this->diffSeconds = $this->endTime - $this->startTime;
    }
}

echo "Testing time below 24h", PHP_EOL;
$timer = new TestTimer();
$timer->setSeconds($timer::SECONDS_24H - 1000);
if($timer->getTimeFormatted() !== '23:43:20') die(FAIL);
if($timer->getSecondsRounded() !== 85400) die(FAIL);
echo PASS;

echo "Testing time up to 1 day", PHP_EOL;
$timer = new TestTimer();
$timer->setSeconds($timer::SECONDS_24H + 1000);
if($timer->getTimeFormatted() !== '1 day 00:16:40') die(FAIL);
if($timer->getSecondsRounded() !== 87400) die(FAIL);
echo PASS;

echo "Testing time up to 1 week", PHP_EOL;
$timer = new TestTimer();
$timer->setSeconds($timer::SECONDS_24H * 7 + 1000);
if($timer->getTimeFormatted() !== '7 days 00:16:40') die(FAIL);
if($timer->getSecondsRounded() !== 605800) die(FAIL);
echo PASS;

echo "Testing Progress", PHP_EOL;
$timer = new TestTimer();
$timer->setTotal(100);
echo $timer->getProgressAsciiBar(), PHP_EOL;
$timer->setDone(88);
echo $timer->getProgressAsciiBar(), PHP_EOL;
echo $timer->getProgressPercentage(), PHP_EOL;
echo $timer->getProgressDone(), PHP_EOL;
echo PHP_EOL;

echo "Testing Progress Format", PHP_EOL;
$timer = new TestTimer();
$timer->setTotal(1234);
$timer->setDone(567);
echo $timer->getProgress(), PHP_EOL;
echo $timer->getProgress('%p %b'), PHP_EOL;
echo $timer->getProgress('%c %b %p'), PHP_EOL;
echo PHP_EOL;

echo "Testing Progress Overflow", PHP_EOL;
$timer = new TestTimer();
$timer->setTotal(100);
$timer->setDone(150);
echo $timer->getProgress(), PHP_EOL;
echo $timer->getProgressPercentage(), PHP_EOL;
echo $timer->getProgressDone(), PHP_EOL;
echo PHP_EOL;

echo "Testing Sleep", PHP_EOL;
$timer = new TestTimer();
sleep(5);
$timer->stop();
echo $timer->getMilliseconds(), PHP_EOL;
echo PHP_EOL;


exit(0);
