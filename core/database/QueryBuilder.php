<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function selectAll($table)
    {
        // Double quotes ARE necessary here!
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        // sprintf returns a formatted string
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            // implode is used to convert the array elements into a string
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        }
        catch (Exception $e) {
            die('Something went wrong.');
        }
    }
}
