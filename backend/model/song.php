<?php

class SongSerializer implements ModelSerializer {

    function serialize(Model|Song $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(100)", "title", $model->getTitle());
        $writer->write("VARCHAR(100)", "artist", $model->getArtist());
        $writer->write("VARCHAR(70)", "album", $model->getAlbum());
        $writer->write("VARCHAR(70)", "genre", $model->getGenre());
        $writer->write("TEXT", "lyric", $model->getLyric());
        $writer->write("BIGINT", "releaseDate", $model->getReleaseDate());
        $writer->write("BIGINT", "duration", $model->getDuration());

        $writer->add_foreign_key("artist", "artist", "name");
    }

    function deserialize(array $result): Model
    {
        return new Song(
            $result["title"],
            $result["artist"],
            $result["album"],
            $result["genre"],
            $result["lyric"],
            $result["releaseDate"],
            $result["duration"]
        );
    }
}

readonly class Song implements Model {
    protected String $title;
    protected String $artist;
    protected String $album;
    protected String $genre;
    protected String $lyric;
    protected int $releaseDate;
    protected int $duration;

    function __construct(
        String $title,
        String $artist,
        String $album,
        String $genre,
        String $lyric,
        int $releaseDate,
        int $duration
    ) {
        $this->title = $title;
        $this->artist = $artist;
        $this->album = $album;
        $this->genre = $genre;
        $this->lyric = $lyric;
        $this->releaseDate = $releaseDate;
        $this->duration = $duration;
    }

    public function getId(): string
    {
        return $this->title;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
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
    public function getAlbum(): string
    {
        return $this->album;
    }

    /**
     * @return String
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @return String
     */
    public function getLyric(): string
    {
        return $this->lyric;
    }

    public function getReleaseDate(): int
    {
        return $this->releaseDate;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

}