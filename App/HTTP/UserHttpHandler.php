<?php

namespace App\HTTP;



use Core\DataBinding;
use Core\Template;
use App\DTO\UserDTO;
use App\Service\UserService;

class UserHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService,
                                Template $template,
                                DataBinding $binder)
    {
        parent::__construct($template, $binder);
        $this->userService = $userService;
    }

    public function login(array $formData = []){
        if (!isset($formData['login'])) {
            $this->render("users/login");
        } else {
            $this->handleLoginProcess($formData);
        }
    }
    public function handleLoginProcess(array $formData = [])
    {
        try {
            $currentUser = $this->userService->login($formData['username'], $formData['password']);
            $_SESSION['id'] = $currentUser->getUserId();
            $this->render("users/profile", $currentUser);
        } catch (\Exception $e) {
            $user = $this->binder->bind($formData, UserDTO::class);
            $this->render("users/login", $user, [$e->getMessage()]);
        }
    }
    public function register(array $formData = [])
    {
        if (!isset($formData['register'])) {
            $this->render("users/register");
        } else {
            $this->handleRegisterProcess($formData);
        }


    }
    public function handleRegisterProcess(array $formData = [])
    {

        try {
            $user = $this->binder->bind($formData, UserDTO::class);

            $this->userService->register($user, $formData['confirm_password']);

            $this->redirect("login.php");
        } catch (\Exception $e) {
            $user = $this->binder->bind($formData, UserDTO::class);
            $this->render("users/register", $user, [$e->getMessage()]);
        }
    }

    public function profile()
    {
        $currentUser = $this->userService->currentUser();
        $this->render("users/profile", $currentUser);

    }

}