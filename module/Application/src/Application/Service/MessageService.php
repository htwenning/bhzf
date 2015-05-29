<?php
namespace Application\Service;

use Application\Model\Message;

class MessageService implements MessageServiceInterface
{

    protected $data = array(
        array(
            'id' => 1,
            'content' => 'hello world',
            'email' => 'aa@bh.org'
        ),
        array(
            'id' => 2,
            'content' => 'aa',
            'email' => 'bb@bh.org'
        )
    );

    public function findAllMessages()
    {
        $allMessages=array();
        foreach($this->data as $index=>$message){
            $allMessages[]=$this->findMessage($index);
        }
        return $allMessages;
    }
    public function findMessage($id){
        $messageData=$this->data[$id];
        $model=new Message();
        $model->setId($messageData['id']);
        $model->setContent($messageData['content']);
        $model->setText($messageData['email']);
        return $model;
    }
}