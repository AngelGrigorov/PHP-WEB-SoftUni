<?php

session_start();
spl_autoload_register();

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repository\UserRepository($db, $dataBinder);
$encryptionService = new \App\Service\Encryption\BcryptEncryptionService();
$userService = new \App\Service\UserService($userRepository, $encryptionService);
$userHttpHandler = new \App\Http\UserHttpHandler($template, $dataBinder, $userService);


$townRepository = new \App\Repository\TownRepository($db);
$townService = new \App\Service\TownsService($townRepository);

$roomRepository = new \App\Repository\RoomRepository($db);
$roomService = new \App\Service\RoomService($roomRepository);

$itemRepository = new \App\Repository\OfferRepository($db);
$itemService = new \App\Service\OfferService($itemRepository, $userRepository);

$itemHttpHandler = new \App\Http\OfferHttpHandler($template, $dataBinder, $townService, $roomService, $itemService );
