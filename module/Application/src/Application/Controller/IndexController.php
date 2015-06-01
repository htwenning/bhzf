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
use Zend\View\Helper\ViewModel;
use Application\Model\Entity\Favour;

class IndexController extends AbstractActionController
{

    protected $messageService;
    protected $favourTable;
    protected $username;
    public function getFavourTable(){
        if(!$this->favourTable){
            $sm=$this->getServiceLocator();
            $this->favourTable=$sm->get('Application\Model\FavourTable');
        }
        return $this->favourTable;
    }
    public function __construct(MessageServiceInterface $messageService)
    {
        session_start();
        $this->messageService = $messageService;
    }

    public function indexAction()
    {
        $this->username='微博用户';
        $_SESSION['username']=$this->username;
        $_SESSION['loginUrl']='#';
        $_SESSION['nav']='index';
        $favours=$this->getFavourTable()->fetchAll();
        return array(
            'messages'=>$this->messageService->findAllMessages(),
            'favourNum'=>count($favours),
        );
    }
    public function addFavourAction(){
        $request=$this->getRequest();
        $response=$this->getResponse();
        if($request->isPost()){
            $post_data=$request->getPost();
            $favour=new Favour();
            $favour->exchangeArray($post_data);
            //插入新的favour
            $this->getFavourTable()->saveFavour($favour);
            $favours=$this->getFavourTable()->fetchAll();
        }
        $response->setContent(\Zend\Json\Json::encode(array('num'=>count($favours))));
        return $response;
    }
 
}
