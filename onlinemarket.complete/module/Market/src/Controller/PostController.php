<?php
namespace Market\Controller;

use Model\Table\ListingsTable;
use Market\Form\PostForm;
use Laminas\Form\FormInterface;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Db\TableGateway\TableGatewayInterface;

class PostController extends AbstractActionController
{
    const ERROR_POST = 'ERROR: unable to validate item information';
    const ERROR_SAVE = 'ERROR: unable to save item to the database';
    const SUCCESS_POST = 'SUCCESS: item posted OK';

    protected TableGatewayInterface $listingsModel;
    protected TableGatewayInterface $cityCodesModel;
    protected FormInterface $postForm;
    public function __construct(ListingsTable $listingsTable, PostForm $postForm) {
        $this->listingsTable = $listingsTable;
        $this->postForm = $postForm;
    }

    public function indexAction()
    {
        $data = [];
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $this->breakoutCityAndCountry($data);
            $this->postForm->setData($data);
            if ($this->postForm->isValid()) {
                if ($this->listingsTable->save($this->postForm->getData())) {
                    $this->flashMessenger()->addMessage(self::SUCCESS_POST);
                    //*** EVENTMANAGER LAB: trigger a log event and pass the online market item title as a parameter
                    return $this->redirect()->toRoute('market');
                } else {
                    $this->flashMessenger()->addMessage(self::ERROR_SAVE);
                }
            } else {
                $this->flashMessenger()->addMessage(self::ERROR_POST);
            }
        }
        return new ViewModel(['postForm' => $this->postForm, 'data' => $data]);
    }

    protected function breakoutCityAndCountry(&$data)
    {
        if (isset($data['cityCode']) && strpos($data['cityCode'], ','))
            list($data['city'],$data['country']) = explode(',', $data['cityCode']);
    }
}
