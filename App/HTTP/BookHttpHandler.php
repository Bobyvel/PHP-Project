<?php

namespace App\HTTP;


use App\DTO\EditDTO;
use App\DTO\BookDTO;
use App\Service\CategoryService;
use Core\DataBinding;
use Core\Template;
use App\Service\TaskService;
use App\Service\UserService;


class BookHttpHandler extends HttpHandlerAbstract
{

    /**
     * @var Template
     */
    private $template;

    /**
     * @var TaskService
     */
    private $task_service;
    /**
     * @var UserService
     */
    private $user_service;
    /**
     * @var DataBinding
     */
    protected $binder;

    /**
     * TaskHttp constructor.
     * @param Template $template
     * @param DataBinding $binder
     * @param TaskService $task_service
     * @param UserService $user_service
     */
    public function __construct(DataBinding $binder,Template $template,TaskService $task_service, UserService $user_service)
    {
        parent::__construct($template, $binder);
        $this->task_service = $task_service;
        $this->user_service = $user_service;
    }

    public function dashboard(){

        try {
            $user = $this->user_service->currentUser();
            if (!$user) {
                $this->redirect('login.php');
            }
            $data = $this->task_service->getList($user->getUserId());

            $this->render('tasks/all', $data);
        }catch (\Exception $e){

        }

    }

    public function myBooks(){

        try {
            $user = $this->user_service->currentUser();

            if (!$user) {
                $this->redirect('login.php');
            }
            $data = $this->task_service->getMyList($user->getUserId());

            $this->render('tasks/my_books', $data);
        }catch (\Exception $e){

        }

    }

    public function viewBook(array $getData = []){

        $book = $this->task_service->getOneBook($getData['id']);
        $this->render('tasks/view', $book);

    }


    public function add(TaskService $taskService,
                        CategoryService $categoryService,
                        array $formData = [])
    {
        /** @var EditDTO $taskDTO */
        $task = $this->binder->bind($formData, BookDTO::class);
        $editDTO = new EditDTO();
        $editDTO->setBook($task);
        $editDTO->setGenres($categoryService->getAll());

        if(isset($formData['add'])){
            $this->handleInsertProcess($taskService, $formData);
        }else{
            $this->render("tasks/add_book", $editDTO);
        }
    }

    /**
     * @param $taskService
     * @param $userService
     * @param $categoryService
     * @param $formData
     * @throws \Exception
     */
    private function handleInsertProcess($taskService, $formData)
    {

        /** @var BookDTO $book */
        $book = $this->binder->bind($formData, BookDTO::class);

        $book->setUserId($_SESSION['id']);
        $book->setGenreId(intval($formData['genre_id']));

        /** @var TaskService $taskService */
        $taskService->add($book);
        $this->redirect("my_books.php");

    }


    public function editBook(TaskService $taskService,
                         CategoryService $categoryService,
                         array $formData = [], array $getData = []){

        $book = $taskService->getOneBook($getData['id']);
        $editDTO = new EditDTO();
        $editDTO->setBook($book);
        $editDTO->setGenres($categoryService->getAll());
        if (!isset($formData['edit'])) {
            $this->render('tasks/edit', $editDTO);
        } else {
            $this->handleEditProcess($taskService, $formData, $getData);
        }

    }

    public function handleEditProcess(TaskService $taskService,
                                      array $formData = [], array $getData = [])
    {
        try {
            /** @var BookDTO $book */
            $book = $this->binder->bind($formData, BookDTO::class);
            $book->setUserId($_SESSION['id']);
            $book->setGenreId(intval($formData['genre_id']));

            /** @var TaskService $taskService */
            $taskService->edit($book, intval($getData['id']));
            $this->redirect("my_books.php");
        }catch (\Exception $ex){

        }

    }

    public function delete(array $data)
    {
        var_dump($data);
        if(!isset($data['task_id'])){
            throw new \Exception('No book id');
        }
        $this->task_service->delete($data['task_id']);
        $this->redirect('my_books.php');
    }

}