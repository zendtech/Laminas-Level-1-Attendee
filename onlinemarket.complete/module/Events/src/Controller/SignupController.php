<?php
namespace Events\Controller;
use Events\Traits\ {EventTableTrait, RegistrationTableTrait, AttendeeTableTrait};
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SignupController extends AbstractActionController
{
    use EventTableTrait;
    use RegistrationTableTrait;
    use AttendeeTableTrait;

    public function __construct(
        $eventTable,
        $registrationTable,
        $attendeeTable
    )
    {
        $this->setEventTable($eventTable);
        $this->setRegistrationtable($registrationTable);
        $this->setAttendeeTable($attendeeTable);
    }

    public function indexAction()
    {
        $eventId = (int) $this->params('event');
        if ($eventId) {
            return $this->eventSignup($eventId);
        }
        $events = $this->eventTable->findAll();
        return new ViewModel(array('events' => $events));
    }

    protected function eventSignup($eventId)
    {
        $event = $this->eventTable->findById($eventId);
        if (!$event) return $this->notFoundAction();
        $vm = new ViewModel(array('event' => $event));
        if ($this->request->isPost()) {
            $this->processForm($this->params()->fromPost(), $eventId);
            $vm->setTemplate('events/signup/thanks.phtml');
        } else {
            $vm->setTemplate('events/signup/form.phtml');
        }
        return $vm;
    }

    protected function processForm(array $formData, int $eventId)
    {
        $regId = $this->registrationTable->persist($eventId, $formData['first_name'], $formData['last_name']);
        $ticketData = $formData['ticket'];
        foreach ($ticketData as $nameOnTicket) {
            $this->attendeeTable->persist($regId, $nameOnTicket);
        }
        return true;
    }
}
