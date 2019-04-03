<?php

require_once "common.php";

$task_repository = new \App\Repository\BookRepository($db);
$task_service = new \App\Service\TaskService($task_repository);
$user_repository = new \App\Repository\UserRepository($db);
$user_service = new \App\Service\UserService($user_repository);
$task = new \App\HTTP\BookHttpHandler($dataBinder,$template,$task_service,$user_service);
$task->delete($_GET);