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
        $sql = "SELECT * FROM `{$table}` WHERE `{$field_name}` = '{$field_value}'";
        $result = self::$connection->query($sql);
        $row = mysqli_fetch_row($result);
        return  $row;
    }

    protected static function getSomeRowsFromTable($table, $count, $offset)
    {
        $sql = "SELECT * FROM $table LIMIT $count OFFSET $offset";
        $result = self::$connection->query($sql);
        $rows = [];
        while ($row = mysqli_fetch_row($result)){
            $rows[] = $row;
        };
        return $rows;
    }

    protected static function getSomeRowsFromTableSort($table, $count, $sort, $offset)
    {
        $sql = "SELECT * FROM $table ORDER BY $sort ASC LIMIT $count OFFSET $offset";
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
        $result = self::$connection->query($sql);
    }

    protected static function updateToTable($table, $values, $field_name, $field_value)
    {
        $index = 0;
        $sql = "UPDATE `{$table}` SET ";
        foreach ($values as $param => $value){
            $sql .= "`{$param}` = " . "'{$value}'";
            $index++;
            if ($index < count($values)) {
                $sql .=", ";
            }
            else {
                $sql .= " WHERE `{$field_name}`='{$field_value}'";
            }
        }
        $result = self::$connection->query($sql);
    }

    protected static function getRowsCount($table){
        $sql = "SELECT COUNT(*) FROM `{$table}`";
        $result = mysqli_fetch_row(self::$connection->query($sql))[0];
        return $result;
    }

    private static function sql_query($sql)
    {
        return self::$connection->query($sql);
    }

}