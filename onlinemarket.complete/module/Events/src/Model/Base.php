<?php
namespace Events\Model;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\{TableGateway};

abstract class Base
{
    public static $tableName;
    protected $tableGateway;
    protected $eventManager;
    //*** ABSTRACT FACTORIES LAB: need to create a constructor which calls this method
    public function setTableGateway(Adapter $adapter)
    {
        $this->tableGateway = new TableGateway(static::$tableName, $adapter);
    }
    //*** EVENTMANAGER LISTENER AGGREGATE LAB: add methods to get and set the event manager
}
