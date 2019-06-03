<?php
require_once 'common.php';
$categoryId = 1;
if (isset($_GET['category_id'])) {
    $categoryId = (int)$_GET['category_id'];
}

require_once 'db/category_queries.php';
require_once 'db/tag_queries.php';
$categories = getAllCategories($db);
$tags = getAllTags($db);

if (isset($_POST['title'], $_POST['body'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category = $_POST['category'];
    $existingTags = isset($_POST['existing_tags']) ? $_POST['existing_tags'] : [];
    $newTags = explode(',', $_POST['new_tags']);
    require_once 'db/question_queries.php';

    $result = createQuestion($db, $userId, $title, $body, $category, $existingTags, $newTags);

    if ($result) {
        header("Location: " . url("question.php?id=$result"));
        exit;
    }
}

require_once 'templates/ask_question.php';