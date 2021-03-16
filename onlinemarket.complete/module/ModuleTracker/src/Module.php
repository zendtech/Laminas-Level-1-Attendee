<?php
namespace ModuleTracker;

use Laminas\ModuleManager\ {ModuleManager,ModuleEvent};

class Module
{
    //*** MODULE EVENTS LAB: make sure this directory path exists and is writeable
    const TRACKER_FILE  = __DIR__ . '/../../../data/logs/tracker.log';    
    //*** MODULE EVENTS LAB: in the "init()" method attach "tracker" as a listener to the ModuleManager::EVENT_LOAD_MODULE event
    public function init(ModuleManager $mm)
    {
        // clear log
        file_put_contents(self::TRACKER_FILE, '');
        // attach listener to module event
        $em = $mm->getEventManager();
        $em->attach(ModuleEvent::EVENT_LOAD_MODULE, [$this, 'tracker'], 99);
    }
    //*** MODULE EVENTS LAB: define the "tracker()" method
    public function tracker(ModuleEvent $e)
    {
        // time : module name
        $message = sprintf('%20s : %40s' . PHP_EOL, date('Y-m-d H:i:s'), $e->getModuleName());
        error_log($message, 3, self::TRACKER_FILE);
    }
}
