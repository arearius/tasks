<?php


class Task extends Db
{
    private $tableName = 'tasks';

    public function __construct()
    {
        //подключение к БД. Данные для подключения берутся из конфига
        parent::connect(config::$db['host'], config::$db['user'], config::$db['password'], config::$db['db_name'], config::$db['tables']);

        //при инициализации приложения смотрим, есть ли таблицы в БД. Если нет, то создаем
       if (!$this->checkFormTables()) {
           //Ошибка при инициализации приложения
       }
    }

    private function checkFormTables(){
        foreach (config::$db['tables'] as $table) {
            if (!parent::checkTable($table)){
                echo "Создаем таблицу $table, т.к. ее нет в БД" . PHP_EOL;
                $this->createFormTable($table);
            };
        }
        return true;
    }


    private function createFormTable($table){
        $fields = config::$tablesStructure[$table]['fields'];
        $primaryKey = config::$tablesStructure[$table]['primaryKey'];;
        parent::createTable($table, $fields, $primaryKey);
    }

    public function getTasks($page, $sort=0){
	    $tasks = parent::getSomeRowsFromTable($tableName, 3);
	    return $tasks;
    }

    public function addTask($newTask){
        parent::insertToTable($tableName, $values);
	    echo $sql;
    }

    public function updateTask($newTask){
        $task = parent::getByFieldFromTable($tableName, 'id', $newTask['id']);
        if ($task['text'] != $newTask['text']) $newTask['modified'] = 1;
        parent::updateToTable($tableName, $values, $field_name, $field_value);
	    echo $sql;
    }
}
