<?php
namespace Guestbook\Service;
use Guestbook\Model\GuestbookModel;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGatewayInterface;
use Laminas\EventManager\EventManagerInterface;

class GuestbookService
{
    const TABLE_NAME = 'guestbook',
          IDENTIFIER = 'guestbook-service',
          EVENT_PRE_INSERT  = 'guestbook-service-pre-insert',
          EVENT_POST_INSERT = 'guestbook-service-post-insert';

    protected $table, $adapter, $eventManager;

    public function __construct(
        protected AdapterInterface $adapter,
        protected EventManagerInterface $eventManager,
        protected TableGatewayInterface $tableGateway)
    {
        $this->adapter = $adapter;
        $this->eventManager = $eventManager;
        $this->table = $tableGateway;
    }

    public function findAll()
    {
        return $this->table->select();
    }
    public function add(GuestbookModel $model)
    {
        unset($model->submit);
        $model->dateSigned = date('Y-m-d H:i:s');
        $this->eventManager->trigger(self::EVENT_PRE_INSERT, $this, ['model' => $model]);
        $result = $this->table->insert($model->extract());
        $this->eventManager->trigger(self::EVENT_POST_INSERT, $this, ['result' => $result]);
        return $result;
    }
}
