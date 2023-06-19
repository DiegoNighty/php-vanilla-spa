<?php

class EventSerializer implements ModelSerializer {
    function serialize(Model|Event $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(80) NOT NULL", "artist", $model->getArtist());
        $writer->write("VARCHAR(120) NOT NULL", "location", $model->getLocation());
        $writer->write("BIGINT NOT NULL", "date", $model->getDate());
        $writer->write("VARCHAR(50) NOT NULL", "type", $model->getType());

        $writer->add_foreign_key("artist", "artist", "name");
    }

    function deserialize(array $result): Model
    {
        return new Event(
            $result["artist"],
            $result["location"],
            $result["date"],
            $result["type"]
        );
    }
}

readonly class Event implements Model {
    public String $artist;
    public String $location;
    public int $date;
    public String $type;

    function __construct(
        String $artist,
        String $location,
        int $date,
        String $type
    ) {
        $this->artist = $artist;
        $this->location = $location;
        $this->date = $date;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->artist;
    }

    /**
     * @return String
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * @return String
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @return String
     */
    public function getType(): string
    {
        return $this->type;
    }
}