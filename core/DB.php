<?php

namespace core;

class DB
{
    public $pdo;

    public function __construct($host, $name, $login, $password)
    {

        $this->pdo = new \PDO("mysql:host={$host};dbname={$name}", $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]);

    }

    protected function where($where)
    {
        if (is_array($where)) {
            if (empty($where)) {
                return '';
            }
            $where_string = "WHERE ";
            $where_fields = array_keys($where);
            $parts = [];
            foreach ($where_fields as $field) {
                $parts[] = "{$field} = :{$field}";
            }
            $where_string .= implode(' AND ', $parts);
        } elseif (is_string($where)) {
            $where_string = $where;
        } else {
            $where_string = '';
        }
        return $where_string;
    }
    public function query($sql)
    {
        return $this->pdo->query($sql);
    }
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }



    public function select($table, $fields = "*", $where = null)
    {
        if (is_array($fields)) {
            $fields_string = implode(',', $fields);
        } elseif (is_string($fields)) {
            $fields_string = $fields;
        } else {
            $fields_string = "*";
        }

        $where_string = $this->where($where);
        $sql = "SELECT {$fields_string} FROM {$table} {$where_string}";

        $sth = $this->pdo->prepare($sql);

        if (is_array($where) && !empty($where)) {
            foreach ($where as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }
        }

        $sth->execute();
        return $sth->fetchAll();
    }
    public function customSelect($table, $fields = "*", $whereClause = '')
    {
        // Формування SQL-запиту з урахуванням переданої умови $whereClause
        $sql = "SELECT {$fields} FROM {$table} {$whereClause}";

        // Підготовка та виконання запиту
        $sth = $this->pdo->prepare($sql);
        $sth->execute();

        // Повернення результатів запиту
        return $sth->fetchAll();
    }




    public function insert($table, $row_to_insert)
    {
        $fields_list = implode(", ", array_keys($row_to_insert));
        $params_array = [];
        foreach ($row_to_insert as $key => $value) {
            $params_array  [] = ":{$key}";
        }
        $params_list = implode(',', $params_array);
        $sql = "INSERT INTO {$table} ({$fields_list}) VALUES ({$params_list})";
        $sth = $this->pdo->prepare($sql);
        foreach ($row_to_insert as $key => $value)

            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->rowCount();
    }

    public function update($table, $row_to_updarte, $where)
    {
        $where_string = $this->where($where);
        $set_array = [];
        foreach ($row_to_updarte as $key => $value) {
            $set_array[] = "{$key} = :{$key}";
        }
        $set_string = implode(", ", $set_array);
        $sql = "UPDATE {$table} SET {$set_string} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        foreach ($where as $key => $value)
            $sth->bindValue(":{$key}", $value);
        foreach ($row_to_updarte as $key => $value)
            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->rowCount();
    }

    public function delete($table, $where)
    {
        $where_string = $this->where($where);
        $sql = "DELETE FROM {$table} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        foreach ($where as $key => $value) {

            $sth->bindValue(":{$key}", $value);
            $sth->execute();
        }
        return $sth->rowCount();
    }

}