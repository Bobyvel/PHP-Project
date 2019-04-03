<?php
require_once 'common.php';
$user_repository = new App\Repository\UserRepository($db);
$user_service = new \App\Service\UserService($user_repository);
$user = new \App\HTTP\UserHttpHandler($user_service, $template, $dataBinder);
$user->profile();
