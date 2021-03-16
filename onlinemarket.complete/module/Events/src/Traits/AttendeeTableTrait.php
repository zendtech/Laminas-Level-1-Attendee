<?php
namespace Events\Traits;

trait AttendeeTableTrait
{
    protected $attendeeTable;
    public function setAttendeeTable($table)
    {
        $this->attendeeTable = $table;
    }
}
