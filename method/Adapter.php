<?php

/**
 * 适配模式：在需要转化一个对象的接口使用另外一个对象是，adapter最为合适
 */
class ErrorOjb
{
    private $error = '';

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}

class ErrorLogToCSV
{
    private $errorObj = '';

    public function __construct($errorObj)
    {
        $this->errorObj = $errorObj;
    }

    public function write()
    {
        return $this->errorObj->getError();
    }
}

class ErrorToCSV
{
    const CSV_FILE = 'error.csv';
    private $errorOjb = '';

    public function __construct($errorObj)
    {
        $this->errorOjb = $errorObj;
    }

    public function write()
    {
        return $this->errorOjb->getNumber()
        . $this->errorOjb->getError()
        . $this->errorOjb->getText();
    }
}

class ErrorApadter extends ErrorOjb
{
    private $number, $text;

    public function getNumber()
    {
        $this->number = 4;

        return $this->number;
    }

    public function getText()
    {
        $this->text = 'Not find';

        return $this->text;
    }
}

$adper = new ErrorApadter('4:not find');

$errorCsv = new ErrorToCSV($adper);
echo $errorCsv->write();