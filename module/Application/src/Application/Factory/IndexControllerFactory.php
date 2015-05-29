<?php
namespace Application\Factory;

use Application\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface{
    public function createService(ServiceLocatorInterface $serviceLocator){
        $realServiceLocator= $serviceLocator->getServiceLocator();
        $messageService =$realServiceLocator->get('Application\Service\MessageServiceInterface');
        return new IndexController($messageService);
    }
}