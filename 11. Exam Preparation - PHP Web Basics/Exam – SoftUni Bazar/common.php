<?php

session_start();
spl_autoload_register();

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repository\UserRepository($db, $dataBinder);
$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\UserService($userRepository, $encryptionService);
$userHttpHandler = new \App\Http\UserHttpHandler($template, $dataBinder, $userService);


$categoryRepository = new \App\Repository\CategoryRepository($db);
$categoryService = new \App\Service\CategoryService($categoryRepository);

$itemRepository = new \App\Repository\ItemRepository($db);
$itemService = new \App\Service\ItemService($itemRepository);

$itemHttpHandler = new \App\Http\ItemHttpHandler($template, $dataBinder, $categoryService, $itemService );