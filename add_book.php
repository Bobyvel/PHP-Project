<?php

require_once "common.php";

$taskRepository = new \App\Repository\BookRepository($db);
$taskService = new \App\Service\TaskService($taskRepository);
$categoryService = new \App\Service\CategoryService(new \App\Repository\CategoryRepository($db));
$userService = new \App\Service\UserService(new \App\Repository\UserRepository($db));
$taskHandler = new \App\Http\BookHttpHandler($dataBinder, $template, $taskService, $userService);

$taskHandler->add($taskService, $categoryService, $_POST);

