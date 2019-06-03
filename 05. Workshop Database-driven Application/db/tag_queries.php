<?php

function findTag(PDO $db, string $tagName): int
{
    $query = "SELECT id FROM tags WHERE name = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$tagName]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data && $data['id']) {
        return (int)$data['id'];
    }

    $query = "INSERT INTO tags (name) VALUES (?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$tagName]);

    return (int)$db->lastInsertId();
}


function getAllTags(PDO $db): array
{
    $query = "
        SELECT 
            t.id,
            t.name,
            COUNT(q.id) AS 'questions_count'
        FROM 
          questions_tags AS qt
        INNER JOIN tags t on qt.tag_id = t.id
        INNER JOIN questions q on qt.question_id = q.id
        GROUP BY 
          t.id,
          t.name
        ORDER BY
          questions_count DESC,
          t.name ASC
    ";

    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}