<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ {ViewModel, FeedModel, JsonModel};

class IndexController extends AbstractActionController
{
    protected $testData;
    public function __construct()
    {
        $items = array_combine(range('A','Z'),range(1,26));
        $this->testData = [
            'title'       => __CLASS__,
            'link'        => 'http://onlinemarket.complete/application/feed',
            'description' => 'Testing RSS and JSON Models',
            'items'       => $items,
        ];
    }
    public function indexAction()
    {
        return new ViewModel();
    }
    public function demoAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
    public function jsonAction()
    {
        return new JsonModel($this->testData);
    }
    public function feedAction()
    {
        return new FeedModel($this->testData);
    }
}
