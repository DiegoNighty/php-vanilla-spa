<?php

class ArtistSerializer implements ModelSerializer {
    function serialize(Artist|Model $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(100) NOT NULL UNIQUE", "name", $model->getName());
        $writer->write("VARCHAR(190)", "avatarURL", $model->getAvatarURL());
        $writer->write("TEXT", "description", $model->getDescription());
    }

    function deserialize(array $result): Model
    {

        return new Artist(
            $result["name"],
            $result["avatarURL"],
            $result["description"]
        );
    }
}

readonly class Artist implements Model {
    protected String $name;
    protected String $avatarURL;
    protected String $description;

    function __construct(
        String $name,
        String $avatarURL,
        String $description
    ) {
        $this->name = $name;
        $this->avatarURL = $avatarURL;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return String
     */
    public function getAvatarURL(): string
    {
        return $this->avatarURL;
    }
}