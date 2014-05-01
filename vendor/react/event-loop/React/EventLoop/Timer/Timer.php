<?php

namespace React\EventLoop\Timer;

use InvalidArgumentException;
use React\EventLoop\LoopInterface;

class Timer implements TimerInterface
{
    protected $loop;
    protected $interval;
    protected $callback;
    protected $periodic;
    protected $data;

    public function __construct(LoopInterface $loop, $interval, $callback, $periodic = false, $data = null)
    {
        if (false === is_callable($callback)) {
            throw new InvalidArgumentException('The callback argument must be a valid callable object');
        }

        $this->loop = $loop;
        $this->interval = (float) $interval;
        $this->callback = $callback;
        $this->periodic = (bool) $periodic;
        $this->data = null;
    }

    public function getLoop()
    {
        return $this->loop;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isPeriodic()
    {
        return $this->periodic;
    }

    public function isActive()
    {
        return $this->loop->isTimerActive($this);
    }

    public function cancel()
    {
        $this->loop->cancelTimer($this);
    }
}
