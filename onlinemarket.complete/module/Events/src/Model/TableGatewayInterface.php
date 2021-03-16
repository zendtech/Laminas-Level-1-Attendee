<?php
namespace Events\Model;

use Laminas\Db\Adapter\Adapter;
interface TableGatewayInterface
{
    public function setTableGateway(Adapter $adapter);
}
