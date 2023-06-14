<?php

class ReviewSerializer implements ModelSerializer {

    function serialize(Model|Review $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(100) NOT NULL", "username", $model->getUsername());
        $writer->write("VARCHAR(100) NOT NULL", "songTitle", $model->getSongTitle());
        $writer->write("TEXT", "content", $model->getContent());
        $writer->write("BIGINT", "date", $model->getDate());
        $writer->write("BIGINT", "lastEditDate", $model->getLastEditDate());

        $writer->add_foreign_key("username", "user", "username");
    }

    function deserialize(array $result): Model
    {
        return new Review(
            $result["username"],
            $result["songTitle"],
            $result["content"],
            $result["date"],
            $result["lastEditDate"]
        );
    }
}

class Review implements Model {
    protected readonly String $username;
    protected readonly String $songTitle;
    protected String $content;
    protected readonly int $date;
    protected int $lastEditDate;

    function __construct(
        String $username,
        String $songTitle,
        String $content,
        int $date,
        int $lastEditDate
    ) {
        $this->username = $username;
        $this->songTitle = $songTitle;
        $this->content = $content;
        $this->date = $date;
        $this->lastEditDate = $lastEditDate;
    }

    public function getId(): string
    {
        return $this->songTitle;
    }

    /**
     * @return String
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return String
     */
    public function getSongTitle(): string
    {
        return $this->songTitle;
    }

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getLastEditDate(): int
    {
        return $this->lastEditDate;
    }

    /**
     * @param int $lastEditDate
     */
    public function setLastEditDate(int $lastEditDate): void
    {
        $this->lastEditDate = $lastEditDate;
    }

}