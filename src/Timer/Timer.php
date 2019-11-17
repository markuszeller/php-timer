<?php

namespace markuszeller\Timer;

class Timer
{
    protected $startTime;
    protected $endTime;
    protected $diffSeconds;

    const SECONDS_24H = 24 * 60 * 60;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function stop(): void
    {
        $this->endTime = microtime(true);
        $this->diffSeconds = $this->endTime - $this->startTime;
    }

    public function getSecondsFractioned(): float
    {
        if(!$this->endTime) {
            $this->stop();
        }

        return sprintf("%.2f", $this->diffSeconds);
    }

    public function getSecondsRounded(): int
    {
        if(!$this->endTime) {
            $this->stop();
        }

        return (int)floor($this->diffSeconds + .5);
    }

    public function getTimeFormatted(): string
    {
        $string = '';

        if(!$this->endTime) {
            $this->stop();
        }

        $seconds = $this->diffSeconds;
        if($seconds > self::SECONDS_24H) {
            $days = floor($seconds / self::SECONDS_24H);
            if($days > 0) {
                $string .= $days . ' day';
                if($days > 1) $string .= 's';
                $string .= ' ';
            }
        }

        $string .= gmdate("H:i:s", $seconds);

        return $string;
    }
}
