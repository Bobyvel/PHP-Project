<?php

namespace App\DTO;


class UserDTO
{
    const FIELDS_MAX_LENGTH = 255;
    const USERNAME_MIN_LENGTH = 4;
    const PASSWORD_MIN_LENGTH = 4;
    const FULL_NAME_MIN_LENGTH = 5;

    /**
     * @var int
     */
    private $user_id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     *
     */
    private $fullName;
    /**
     * @var string
     */
    private $bornON;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        DTOValidator::validate(self::USERNAME_MIN_LENGTH, self::FIELDS_MAX_LENGTH, $username, "Username must be between 4 and 255 characters!");

        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::FIELDS_MAX_LENGTH, $password, "Password must be between 4 and 255 characters!");
        $this->password = $password;
    }
    public function setPasswordHash(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $firstName
     */
    public function setFullName($fullName)
    {
        DTOValidator::validate(self::FULL_NAME_MIN_LENGTH, self::FIELDS_MAX_LENGTH, $fullName, "Full name must be between 5 and 255 characters!");
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getBornON()
    {
        return $this->bornON;
    }

    /**
     * @param string $bornON
     */
    public function setBornON($bornON)
    {
        $this->bornON = $bornON;
    }



}