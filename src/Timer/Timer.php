<?php

namespace markuszeller\Timer;

class Timer
{
    protected $startTime;
    protected $endTime;
    protected $diffSeconds;

    protected int $done = 0;
    protected int $total = 0;
    private int $totalStrLength = 0;

    const SECONDS_24H = 24 * 60 * 60;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
        $this->totalStrLength = $len = strlen((string)$this->total);
    }

    public function setDone(int $done): void
    {
        $this->done = $done;
    }

    public function stop(): void
    {
        $this->endTime = microtime(true);
        $this->diffSeconds = $this->endTime - $this->startTime;
    }

    public function getSecondsFractioned(): float
    {
        if (!$this->endTime) {
            $this->stop();
        }

        return sprintf("%.2f", $this->diffSeconds);
    }

    public function getSecondsRounded(): int
    {
        if (!$this->endTime) {
            $this->stop();
        }

        return (int)floor($this->diffSeconds + .5);
    }

    public function getTimeFormatted(): string
    {
        $string = '';

        if (!$this->endTime) {
            $this->stop();
        }

        $seconds = $this->diffSeconds;
        if ($seconds > self::SECONDS_24H) {
            $days = floor($seconds / self::SECONDS_24H);
            if ($days > 0) {
                $string .= $days . ' day';
                if ($days > 1) $string .= 's';
                $string .= ' ';
            }
        }

        $string .= gmdate("H:i:s", $seconds);

        return $string;
    }

    /**
     * Get Progress as string
     *
     * '%b' => ascii bar
     * '%p' => percent
     * '%c' => count
     *
     * @param string $format
     * @return string
     */
    public function getProgress(string $format = '%b %p'): string
    {
        $format = str_replace('%b', $this->getProgressAsciiBar(), $format);
        $format = str_replace('%p', $this->getProgressPercentage(), $format);
        $format = str_replace('%c', $this->getProgressDone(), $format);

        return $format;
    }

    public function getProgressPercentage(): string
    {
        return sprintf('%6.02f%%', $this->getPercentDone());
    }

    private function getPercentDone(): float {
        return max(0,min(100 / $this->total * $this->done, 100));
    }

    public function getProgressAsciiBar(int $chars = 20): string {
        $output = str_repeat("\u{2591}", $chars);
        $fill = str_repeat("\u{2588}", $chars / 100 * $this->getPercentDone());
        $output = substr_replace($output, $fill, 0, strlen($fill));

        return $output;
    }

    public function getProgressDone() {
        return sprintf("%{$this->totalStrLength}d/%{$this->totalStrLength}d", $this->done, $this->total);
    }

    public function getMilliseconds() {
        if (!$this->endTime) {
            $this->stop();
        }

        return $this->diffSeconds * 1000;
    }
}
