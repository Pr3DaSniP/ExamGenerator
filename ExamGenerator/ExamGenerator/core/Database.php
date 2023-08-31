<?php

class Database
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, USER, PWD, );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET NAMES 'utf8'");
    }

    public function select($sql): array
    {
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($sql)
    {
        $this->pdo->exec($sql);
    }

    public function queryWithParams($sql, $params)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function update($sql)
    {
        $result = $this->pdo->exec($sql);
        if ($result === 0) {
            return false;
        }
        return true;
    }

    public function delete($sql)
    {
        $result = $this->pdo->exec($sql);
        if ($result === 0) {
            return false;
        }
        return true;
    }
}