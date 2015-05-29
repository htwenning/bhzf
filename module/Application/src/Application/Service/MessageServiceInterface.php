<?php
namespace Application\Service;

use Application\Model\MessageInterface;

interface MessageServiceInterface{
    public function findAllMessages();
    public function findMessage($id);
}