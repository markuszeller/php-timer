<?php

namespace markuszeller\Timer;

class Timer
{
    protected $startTime;
    protected $endTime;
    protected $diffSeconds;

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
        if(!$this->endTime) {
            $this->stop();
        }

        return gmdate("H:i:s", $this->diffSeconds);
    }
}
