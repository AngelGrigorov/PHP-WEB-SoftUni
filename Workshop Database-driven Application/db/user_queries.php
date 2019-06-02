<?php

function hasLiked(PDO $db, $userId, $questionId): bool
{
    $query = "SELECT * FROM user_likes WHERE user_id = ? AND question_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);
    return !empty($stmt->fetchAll(PDO::FETCH_ASSOC));
}


function removeLike(PDO $db, $userId, $questionId)
{
    $query = "DELETE FROM user_likes WHERE user_id = ? AND question_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);
}

function like(PDO $db, $userId, $questionId)
{
    $query = "INSERT INTO user_likes (user_id, question_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);
}

function logout(PDO $db, string $authId)
{
    $query = "DELETE FROM authentications WHERE auth_string = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$authId]);
}

function getRolesByUserId(PDO $db, int $userId): array
{
    $query = "
        SELECT
          r.name          
        FROM
          users_roles ur
        INNER JOIN roles r on ur.role_id = r.id
        WHERE user_id = ?
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);

    return array_map(function($r) { return $r['name'];}, $stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getUserByAuthId(PDO $db, string $authId): int
{
    $query = "
        SELECT 
          user_id
        FROM
          authentications
        WHERE 
          auth_string= ? 
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$authId]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data && $data['user_id']) {
        return (int)$data['user_id'];
    }

    return -1;
}

function issueAuthenticationString(PDO $db, int $userId): string
{
    $query = "
        SELECT 
          auth_string
        FROM
          authentications
        WHERE 
          user_id = ? 
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data && $data['auth_string']) {
        return $data['auth_string'];
    }

    $authString = uniqid();
    $query = "
        INSERT INTO
          authentications (
            auth_string, 
            user_id
          ) VALUES (
            ?,
            ?
          )
    ";

    $stmt = $db->prepare($query);
    $stmt->execute(
        [
            $authString,
            $userId
        ]
    );

    return $authString;
}

function verifyCredentials(PDO $db, string $username, string $password): int
{
    $query = "
        SELECT 
            id, 
            password
        FROM
          users
        WHERE
          username = ?
    ";

    $stmt = $db->prepare($query);
    if (!$stmt->execute([$username])) {
        return -1;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $passwordHash = $user['password'];

    $result = password_verify($password, $passwordHash);

    if ($result) {
        return (int)$user['id'];
    }

    return -1;
}

function register(PDO $db, string $username, string $password): bool
{
    $query = "
        INSERT INTO 
          users (
            username, 
            password
          )
        VALUES (
            ?,
            ?
        )
    ";

    $statement = $db->prepare($query);
    $result = $statement->execute(
        [
            $username,
            password_hash($password, PASSWORD_ARGON2I)
        ]
    );

    $userId = $db->lastInsertId();

    $roles = ['USER'];

    if ($userId == 1) {
        $roles[] = 'ADMIN';
    }

    foreach ($roles as $roleName) {
        $query = "SELECT id FROM roles WHERE name = '$roleName'";
        $roleId = $db->query($query)->fetch(PDO::FETCH_ASSOC)['id'];
        $query = "INSERT INTO users_roles (user_id, role_id) VALUES ($userId, $roleId)";
        $db->query($query);
    }

    return $result;
}
