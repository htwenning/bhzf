<?php
namespace Application\Model;

interface MessageInterface{
    public function getId();
    public function getContent();
    public function getEmail();
}