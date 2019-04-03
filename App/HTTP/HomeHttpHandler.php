<?php

namespace App\HTTP;


use App\DTO\UserDTO;
use App\Service\TaskService;

class HomeHttpHandler extends HttpHandlerAbstract
{
    public function index()
    {
       if (isset($_SESSION['user_id'])) {
            $this->redirect('all_books.php');
        } else {
            $this->render('home/index');
        }
    }



}