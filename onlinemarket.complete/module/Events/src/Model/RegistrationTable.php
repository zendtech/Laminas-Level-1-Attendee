<?php
namespace Events\Model;
use Laminas\Db\Sql\Sql;
class RegistrationTable extends Base
{
    public static $tableName = 'registration';
    public function findAllForEvent($eventId)
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from(['r' => RegistrationTable::$tableName])
               ->join(['a' => AttendeeTable::$tableName],
                       'a.registration_id = r.id')
               ->where(['r.event_id' => $eventId]);
        return $this->tableGateway->selectWith($select)->toArray();
    }
    public function persist($eventId, $firstName, $lastName)
    {
        $this->tableGateway->insert(
            ['event_id' => $eventId,
             'first_name' => $firstName,
             'last_name' => $lastName,
             'registration_time' => date('Y-m-d H:i:s')
             ]
        );
        //*** EVENTMANAGER LISTENER AGGREGATE LAB: trigger a modification event
        return $this->tableGateway->getLastInsertValue();
    }
}
