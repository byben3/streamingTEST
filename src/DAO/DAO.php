<?php

namespace App\src\DAO;



use PDO;
use App\config\autoloader;


abstract class DAO
{

    private $connection;
    private function checkConnection()
    {
        if($this->connection === null) 
        {
            return $this->getConnection();
        }
        return $this->connection;
    }

    private function getConnection()
    {

        try
        {
            $connection = new PDO(DB_HOST, DB_USER ,DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }

        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }

    }

    protected function sql($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->getConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        else{
            $result = $this->getConnection()->query($sql);
            return $result;
        }
    }
}
