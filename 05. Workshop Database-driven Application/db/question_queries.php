<?php
require_once 'tag_queries.php';


function createQuestion(
    PDO $db,
    int $userId,
    string $title,
    string $body,
    int $category,
    array $existingTags,
    array $newTags): int
{
    foreach ($newTags as $newTag) {
        $tagId = findTag($db, $newTag);
        $existingTags[] = $tagId;
    }

    $query = "
        INSERT INTO questions (
          title, 
          body, 
          category_id, 
          author_id, 
          created_on
        ) VALUES (
          ?,
          ?,
          ?,
          ?,
          NOW()          
        );
    ";

    $stmt = $db->prepare($query);
    $stmt->execute(
        [
            $title,
            $body,
            $category,
            $userId
        ]
    );

    $questionId = $db->lastInsertId();

    foreach ($existingTags as $tagId) {
        $query = "INSERT INTO questions_tags (question_id, tag_id) VALUES (?, ?);";
        $stmt = $db->prepare($query);
        $stmt->execute([$questionId, $tagId]);
    }

    return (int)$questionId;
}

function getQuestionById(PDO $db, int $id): array
{
    $query = "
        SELECT
          q.id,
          q.title,
          q.body,
          q.author_id,
          u.username AS 'author_name',
          c.name AS 'category_name',
          c.id AS 'category_id',
          q.created_on
        FROM
          questions AS q
        INNER JOIN users u on q.author_id = u.id
        INNER JOIN categories c on q.category_id = c.id
        WHERE q.id = ?
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}