<?php
class ModelWriter
{
    private array $data = [];
    private array $types = [];
    private array $fields = [];
    private array $constraints = [];

    function add_foreign_key(
        string $field,
        string $table,
        string $targetField,
        string $event = "ON DELETE CASCADE"
    ): ModelWriter {
        $this->constraints[] = "FOREIGN KEY ($field) REFERENCES $table($targetField) $event";
        return $this;
    }

    /**
     * @param String $type
     * @param String $field
     * @param $value
     * @return $this
     */
    function write(
        string $type,
        string $field,
               $value
    ): ModelWriter
    {
        $this->fields[] = $field;
        $this->types[] = $type;
        $this->data[] = '"' . $value . '"';
        return $this;
    }

    function asValues(): string
    {
        return join(', ', $this->data);
    }

    function asDeclaration(): string
    {
        $declaration = join(", ", array_map(fn($field, $type) => "$field $type", $this->fields, $this->types));
        $constraints = join(", ", $this->constraints);

        if ($constraints !== "") {
            return "$declaration, $constraints";
        }

        return "$declaration";
    }
}

interface Model
{
    function getId(): string;
}

interface ModelSerializer
{
    function serialize(Model $model, ModelWriter $writer): void;

    function deserialize(array $result): Model;
}
