<?php

class Repository {

    protected mysqli $driver;
    protected String $table;
    protected String $idField;
    public ModelSerializer $serializer;

    function __construct(
        mysqli $driver,
        String $table,
        String $idField,
        ModelSerializer $serializer
    ) {
        $this->driver = $driver;
        $this->table = $table;
        $this->idField = $idField;
        $this->serializer = $serializer;
    }

    /*
     * @param String $query The query to execute
     * @param array $params The parameters to bind (by default, the table name is bound to :table)
     */
    function query(String $query, array $params): Model {
        $statement = $this->driver->prepare($query);

        $statement->execute(
            array_merge(
                [":table" => $this->table],
                $params
            )
        );

        return $this->serializer->deserialize(
            $statement->get_result()->fetch_assoc()
        );
    }

    function createTable(ModelWriter $writer): bool|mysqli_result
    {
        $declaration = $writer->asDeclaration();
        $sql = "CREATE TABLE IF NOT EXISTS $this->table ( $declaration );";
        return $this->driver->execute_query($sql);
    }

    function save(Model $model): bool
    {
        $writer = new ModelWriter();
        $this->serializer->serialize(
            $model,
            $writer
        );

        $this->createTable($writer);

        $values = $writer->asValues();
        $statement = $this->driver->prepare(
            "REPLACE INTO $this->table VALUES ( $values );"
        );

        return $statement->execute();
    }


    function find(String $id): Model|null {
        $statement = $this->driver->prepare(
            "SELECT * FROM $this->table WHERE $this->idField = '$id'"
        );

        try {
            $statement->execute();
        } catch(Exception $e) {
            return null;
        }

        $result = $statement->get_result()->fetch_assoc();

        if (is_null($result) || sizeof($result) == 0) {
            return null;
        }

        return $this->serializer->deserialize(
            $result
        );
    }

    function findAll(String $id): array|null {
        $statement = $this->driver->prepare(
            "SELECT * FROM $this->table WHERE $this->idField = '$id'"
        );

        $statement->execute();
        $models = [];

        $rs = $statement->get_result();

        while ($result = $rs->fetch_assoc()) {
            if (sizeof($result) == 0) {
                continue;
            }

            $models[] = $this->serializer->deserialize(
                $result
            );
        }

        return $models;
    }

}