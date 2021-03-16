<?php
namespace Events\Traits;

trait RegistrationTableTrait
{
    protected $registrationTable;
    public function setRegistrationtable($table)
    {
        $this->registrationTable = $table;
    }
}
