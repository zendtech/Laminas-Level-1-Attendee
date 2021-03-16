<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Laminas\ZendFrameworkBridge',
    //*** MODULE EVENTS LAB: make sure "ModuleTracker" is first!
    'ModuleTracker',
    'Laminas\Session',
    'Laminas\I18n',
    'Laminas\Form',
    'Laminas\Hydrator',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Db',
    'Laminas\Router',
    'Laminas\Validator',
    'Laminas\I18n',
    'Laminas\Mvc\Plugin\FlashMessenger',
    'Laminas\DeveloperTools',
    'Application',
    'Market',
    'Model',
    'Events',
];
