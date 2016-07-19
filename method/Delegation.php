<?php

/**
 * 委托模式：通过分配或委托其他对象，委托设计模式能够去除核心对象中的判决和复杂的功能性。
 */
class PlayList
{
    protected $song = [];
    protected $playType;

    public function addSong($dir, $name)
    {
        $files = array('dir' => $dir, 'name' => $name);
        $this->song[] = $files;
    }

    public function getPlayList()
    {
        $this->playType->getPlayList($this->song);
    }

    public function __construct($type)
    {
        $this->playType = new $type(); // 委托
    }
}

abstract class PlayType
{
    abstract function getPlayList($song);
}

class Mp3 extends PlayType
{
    public function getPlayList($song)
    {
        echo 'Mp3';
    }
}

class Mp4 extends PlayType
{
    public function getPlayList($song)
    {
        echo 'Mp4';
    }
}

$play = new PlayList('Mp3');
$play->getPlayList();

