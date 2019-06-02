<?php
require_once 'common.php';

if (!hasRole($db, $userId, 'ADMIN')) {
    header("Location: " . url("logout.php"));
    exit;
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    require_once 'db/category_queries.php';
    createCategory($db, $name);
    header("Location: " . url("categories.php"));
    exit;
}

require_once 'templates/create_category.php';