<?php
namespace Application\Model\Entity;

class Favour
{

    protected $username;

    protected $id;

    protected $time;
    
    public function exchangeArray($data){
        $this->id=(!empty($data['id']))?$data['id']:null;
        $this->username=(!empty($data['username']))?$data['username']:null;
        $this->time=(!empty($data['time']))?$data['time']:null;
    }

    /**
     *
     * @return the $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     *
     * @param field_type $username            
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param field_type $time            
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}