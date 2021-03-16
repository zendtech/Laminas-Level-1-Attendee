<?php
namespace Market\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    use ListingsTableTrait;

    public function indexAction()
    {
        return new ViewModel(['item' => $this->listingsTable->findLatest()]);
    }
}
