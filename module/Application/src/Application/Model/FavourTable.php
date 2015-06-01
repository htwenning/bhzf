<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Entity\Favour;

class FavourTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    public function getFavour(){
        $id = (int) $id;
        $rowset=$this->tableGateway->selet(array('id'=>$id));
        $row=$rowset->current();
        if(!$row){
            throw new \Exception("Could not find row $id");
            
        }
        return $row;
    }

    public function saveFavour(Favour $favour)
    {
        $data = array(
            'username' => $favour->getUsername(),
        );
        $id=(int)$favour->getId();
        $this->tableGateway->insert($data);
        if($id==null){
            
        }
        
    }
}