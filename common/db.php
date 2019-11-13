<?php


class Db
{
    private static $connection;

    protected static function connect($sql_host, $sql_user, $sql_pass, $sql_dbname)
    {
        if (self::$connection == null) {
            //echo "<br>try connect db";
            self::$connection = new \mysqli($sql_host, $sql_user, $sql_pass, $sql_dbname);
            //echo "try connect done";

            if(self::$connection->connect_errno){
                echo 'База данных не доступна';
                return true;
            }
        }
    }

    protected static function createTable($name, $fields, $primaryKey)
    {
        $sql = "CREATE TABLE `{$name}` (";
        $fieldNumber = 0;
        foreach ($fields as $fieldName => $fieldProperty) {
            if ($fieldNumber < count($fields) - 1) {
                $sql .= "`$fieldName` $fieldProperty, ";
            } else $sql .= "`{$fieldName}` {$fieldProperty} ";
        }

        $sql .= " PRIMARY KEY(`$primaryKey`))";
	echo $sql;
        self::$connection->query($sql);
    }

    protected static function checkTable($tableName){
        $sql = "CHECK TABLE tasks.$tableName";
        $result = mysqli_fetch_assoc(self::$connection->query($sql));
        if ($result['Msg_text'] === 'OK') return true;
        return false;
    }

    protected static function getAllFromTable($table)
    {
        $sql = "SELECT * FROM $table";
        $result = self::$connection->query($sql);
        $rows = [];
        while ($row = mysqli_fetch_row($result)){
            $rows[] = $row;
        };
        return $rows;
    }
	
	protected static function getByFieldFromTable($table, $field_name, $field_value)
    {
        $sql = "SELECT * FROM `{$table}` WHERE `{$field_name}` = `{$field_value}`";
        $result = self::$connection->query($sql);
        return  mysqli_fetch_row($result);
    }

    protected static function getSomeRowsFromTable($table, $count)
    {
        $sql = "SELECT * FROM $table LIMIT $count";
        echo $sql;
        $result = self::$connection->query($sql);
        $rows = [];
        while ($row = mysqli_fetch_row($result)){
            $rows[] = $row;
        };
        return $rows;
    }

    protected static function insertToTable($table, $values)
    {

        $sql = "INSERT INTO `{$table}` " ;
        $valuesStr = "(";
        $paramsStr = "(";
        $index = 0;
        foreach ($values as $param => $value){
            $valuesStr .= "'{$value}'";
            $paramsStr .= "`{$param}`";
            $index++;
            if ($index < count($values)) {
                $valuesStr .=", ";
                $paramsStr .=", ";
            }
            else {
                $valuesStr .=")";
                $paramsStr .=")";
            }
        }
        $sql .= $paramsStr . " values " . $valuesStr;
        //echo $sql;
        $result = self::$connection->query($sql);
        //print_r($result);
    }

    protected static function updateToTable($table, $values, $field_name, $field_value)
    {

        $sql = "INSERT INTO `{$table}` " ;
        $valuesStr = "(";
        $paramsStr = "(";
        $index = 0;
        foreach ($values as $param => $value){
            $valuesStr .= "'{$value}'";
            $paramsStr .= "`{$param}`";
            $index++;
            if ($index < count($values)) {
                $valuesStr .=", ";
                $paramsStr .=", ";
            }
            else {
                $valuesStr .=")";
                $paramsStr .=")";
            }
        }
        $sql .= $paramsStr . " values " . $valuesStr;
        //echo $sql;
        $result = self::$connection->query($sql);
        //print_r($result);
    }

    protected static function insert($data, $table)
    {
        $sql = "INSERT INTO `$table` (`text`) VALUES ('$data')";
        self::sql_query($sql);
    }

    private static function sql_query($sql)
    {
        return self::$connection->query($sql);
    }

}