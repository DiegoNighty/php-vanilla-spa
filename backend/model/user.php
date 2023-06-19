<?php

class UserSerializer implements ModelSerializer {

    function serialize(Model|User $model, ModelWriter $writer): void
    {
        $writer->write("VARCHAR(50) PRIMARY KEY", "username", $model->getUsername());
        $writer->write("TEXT", "password", $model->getPassword());
        $writer->write("VARCHAR(60)", "mail", $model->getEmail());
        $writer->write("TEXT", "avatarURL", $model->getAvatarURL());
        $writer->write("TEXT", "preferences", $model->getPreferences());
        $writer->write("TEXT", "role", $model->getRole());
    }

    function deserialize(array $result): Model
    {
        return new User(
            $result["username"],
            $result["password"],
            $result["mail"],
            $result["avatarURL"],
            $result["preferences"],
            $result["role"]
        );
    }
}

class User implements Model {
    public readonly String $username;
    public readonly String $password;
    public String $email;
    public String $avatarURL;
    public String $preferences;
    public String $role;

    function __construct(
        String $username,
        String $password,
        String $email,
        String $avatarURL,
        String $preferences,
        String $role = "user"
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->avatarURL = $avatarURL;
        $this->preferences = $preferences;
        $this->role = $role;
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
     * @return string
     */
    public function getPreferences(): String
    {
        return $this->preferences;
    }

    /**
     * @param string $preferences
     */
    public function setPreferences(String $preferences): void
    {
        $this->preferences = $preferences;
    }

    function getId(): string
    {
        return $this->username;
    }

    /**
     * @return String
     */
    public function getRole(): string
    {
        return $this->role;
    }
}
