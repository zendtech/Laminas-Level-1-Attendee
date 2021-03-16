<?php
namespace Events\Traits;

trait EventTableTrait
{
    protected $eventTable;
    public function setEventTable($table)
    {
        $this->eventTable = $table;
    }
}
