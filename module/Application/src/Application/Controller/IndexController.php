<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Service\MessageServiceInterface;

class IndexController extends AbstractActionController
{

    protected $messageService;

    public function __construct(MessageServiceInterface $messageService)
    {
        $this->$messageService = $messageService;
    }

    public function indexAction()
    {
        
    }
}
