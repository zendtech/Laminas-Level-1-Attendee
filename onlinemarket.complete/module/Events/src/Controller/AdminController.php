<?php
namespace Events\Controller;

use Events\Traits\ {EventTableTrait, RegistrationTableTrait};
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{

    use EventTableTrait;
    use RegistrationTableTrait;

    public function __construct($eventTable, $registration) {
        $this->setEventTable($eventTable);
        $this->setRegistrationtable($registration);
    }

    public function indexAction()
    {
        $eventId = $this->params('event');
        if ($eventId) {
            return $this->listRegistrations($eventId);
        }
        $events = $this->eventTable->findAll();
        $viewModel = new ViewModel(array('events' => $events));
        return $viewModel;
    }

    protected function listRegistrations($eventId)
    {
        $registrations = $this->regTable->findAllForEvent($eventId);
        $viewModel = new ViewModel(array('registrations' => $registrations));
        $viewModel->setTemplate('events/admin/list.phtml');
        return $viewModel;
    }
}
