<?php

class UserSerializer implements ModelSerializer {

    function serialize(Model|User $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(50) PRIMARY KEY", "username", $model->getUsername());
        $writer->write("TEXT", "password", $model->getPassword());
        $writer->write("VARCHAR(60)", "mail", $model->getEmail());
        $writer->write("TEXT", "avatarURL", $model->getAvatarURL());
        $writer->write("TEXT", "preferences", join(", ", $model->getPreferences()));
    }

    function deserialize(array $result): Model
    {
        return new User(
            $result["username"],
            $result["password"],
            $result["email"],
            $result["avatarURL"],
            $result["preferences"]
        );
    }
}

class User implements Model {
    protected readonly String $username;
    protected readonly String $password;
    protected String $email;
    protected String $avatarURL;
    protected array $preferences;

    function __construct(
        String $username,
        String $password,
        String $email,
        String $avatarURL,
        array $preferences
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->avatarURL = $avatarURL;
        $this->preferences = $preferences;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getAvatarURL(): string
    {
        return $this->avatarURL;
    }

    /**
     * @param String $avatarURL
     */
    public function setAvatarURL(string $avatarURL): void
    {
        $this->avatarURL = $avatarURL;
    }

    /**
     * @return array
     */
    public function getPreferences(): array
    {
        return $this->preferences;
    }

    /**
     * @param array $preferences
     */
    public function setPreferences(array $preferences): void
    {
        $this->preferences = $preferences;
    }

    function getId(): string
    {
        return $this->username;
    }
}
