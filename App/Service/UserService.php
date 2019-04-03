<?php

namespace App\Service;

use App\DTO\UserDTO;
use App\Repository\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDTO $userDTO, string $confirmPassword): bool
    {
        if (null !== $this->userRepository->findUsername($userDTO->getUsername())){
            throw new \Exception("Username already taken!");
        }
        if ($userDTO->getPassword() !== $confirmPassword){
            throw new \Exception("Passwords did not match");
        }
        /**
         * @var UserDTO $userDTO
         */
        $userDTO->setPasswordHash();
        return $this->userRepository->insertUser($userDTO);

    }

    public function login(string $username, string $password): UserDTO
    {
        $user = $this->userRepository->findUsername($username);

        if (null == $user){
            throw new \Exception("Wrong username or password");
        }
        if (!password_verify($password, $user->getPassword())){
            throw new \Exception("Wrong username or password");
        }
        return $user;

    }

    public function currentUser() :?UserDTO
    {
        if (!isset($_SESSION['id'])) {
            throw new \Exception("No current user!");
        }
        return $this->userRepository->findUser(intval($_SESSION['id']));
    }



}