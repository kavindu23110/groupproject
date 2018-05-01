<?php

/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 10/27/2017
 * Time: 9:27 AM
 */
class LogRecord
{
    protected $date;
    protected $file;
    protected $log;
    protected $path;

public function __construct()
{
    $this->date=date("d.m.Y");
    $this->file="./logrecords";
    $this->log="/log_".$this->date.".txt";
    $this->path=$this->file.$this->log;
    if(!file_exists($this->file)){
        mkdir("logrecords", 0700,true);
    }
if(!file_exists($this->path)){
    fopen($this->path, 'w');
}
$this->file=  fopen($this->path, 'w');
}





}

$a=new LogRecord();


