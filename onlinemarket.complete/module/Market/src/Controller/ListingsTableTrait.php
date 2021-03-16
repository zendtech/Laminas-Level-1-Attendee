<?php
namespace Market\Controller;
use Laminas\Db\TableGateway\TableGatewayInterface;
trait ListingsTableTrait
{
    protected $listingsTable;
    public function __construct(TableGatewayInterface $listingsTable){
        $this->listingsTable = $listingsTable;
    }
}