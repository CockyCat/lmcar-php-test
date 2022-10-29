<?php

namespace App\Service;
use think\facade\Log;

interface LogBase {
    public function info($message);
    public function debug($message);
    public function error($message);
}

class Log4php implements LogBase{
    private $logger;


    public function __construct(){
        $this->logger = \Logger::getLogger("Log");
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->debug($message);
    }
}

class Thinklog implements LogBase{
    private $logger;


    public function __construct(){
        Log::init([
            'default'	=>	'file',
            'channels'	=>	[
                'file'	=>	[
                    'type'	=>	'file',
                    'path'	=>	'./logs/',
                ],
            ],
        ]);
    }

    public function info($message = '')
    {

        Log::info(strtoupper($message));
    }

    public function debug($message = '')
    {
        Log::debug(strtoupper($message));

    }

    public function error($message = '')
    {
        Log::error(strtoupper($message));

    }
}
class LogFactory{
    public static function build($className){
        $className = ucfirst($className);
        if ($className && class_exists($className)){
            return new $className();
        }
        return null;
    }
}

//call log factory
LogFactory::build("Thinklog")->info("Products was sell out!");
LogFactory::build("Log4php")->error("mysql connection was broke!");



/*
class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINKLOG = 'think-log';

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        }
        if ($type == self::TYPE_THINKLOG) {
            $this->logger = \Logger::getLogger("Log");
        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}
*/