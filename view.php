<?php

require_once 'common.php';
$user_repository = new \App\Repository\UserRepository($db);
$user_service = new \App\Service\UserService($user_repository);
$taskRepository = new \App\Repository\BookRepository($db);
$taskService = new \App\Service\TaskService($taskRepository);
$task = new \App\HTTP\BookHttpHandler($dataBinder, $template, $taskService, $user_service);
$task->viewBook($_GET);
