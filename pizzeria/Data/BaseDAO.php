<?php

declare(strict_types=1);

namespace Data;

require_once("DBConfig.php");

class BaseDAO
{
    protected function db_connect(): ?\PDO
    {
        try {
            $dbh =  new \PDO(
                \DBConfig::$DB_CONNSTRING,
                \DBConfig::$DB_USERNAME,
                \DBConfig::$DB_PASSWORD
            );

            $dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $dbh;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return null;
    }
}
