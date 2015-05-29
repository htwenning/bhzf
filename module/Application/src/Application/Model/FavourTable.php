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

    public function saveFavour(Favour $favour)
    {
        $data = array(
            'username' => $favour->username,
        );
        $this->tableGateway->insert($data);
    }
}