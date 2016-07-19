<?php

class Pool
{
    protected $class = '';
    private $instance = array();

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function get()
    {
        if (count($this->instance) > 0) {
            return array_pop($this->instance);
        }

        return new $this->class();
    }

    public function dispose($instance)
    {
        $this->instance[] = $instance;
    }
}

class Processor
{
    private $pool = '';
    private $processing = 0;
    private $maxProcess = 3;
    private $waitingQueue = [];

    public function __constructs(Pool $pool)
    {
        $this->pool = $pool;
    }

    public function process($images)
    {
        if ($this->processing++ < $this->maxProcess) {
            $this->createWorker($images, array($this, 'processDone'));
        } else {
            $this->pushToWaitingQueue($images);
        }
    }

    public function createWorker($images)
    {
        $worker = $this->pool->get();
        $worker->run($images);
    }

    public function pushToWaitingQueue($images)
    {
        $this->waitingQueue[] = $images;
    }

    public function popToWaitingQueue()
    {
        return array_pop($this->waitingQueue);
    }

    public function processDone($worker)
    {
        $this->processing--;
        $this->pool->dispose($worker);

        if (count($this->waitingQueue) > 0) {
            $this->createWorker($this->popToWaitingQueue());
        }
    }
}

class TestWork
{
    public function __construct()
    {
        // TODO something
    }

    public function run($images, array $callback)
    {
        call_user_func($callback, $this);
    }
}