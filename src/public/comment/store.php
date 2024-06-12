<?php
session_start();
$userId = $_SESSION['id'];
$bookId = filter_input(INPUT_POST, 'book_id');
$commenterName = filter_input(INPUT_POST, 'commenter_name');
$commentContent = filter_input(INPUT_POST, 'comment');

// var_dump($commentContent);
// die;

if (empty($commenterName) || empty($commentContent)) {
    $_SESSION['errors'] = 'コメント名かコメント内容が入力されていません！';
    header('Location: ../detail.php?id=' . $bookId);
    exit();
}
// var_dump(empty($commentContent));
// die;

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
    $dbUserName,
    $dbPassword
);

$sql =
    'INSERT INTO comments(user_id, book_id, commenter_name, comment)VALUES(:userId, :bookId, :commenterName, :commentContent)';

    // var_dump($sql);
    // die;

try {
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    $statement->bindParam(':commenterName', $commenterName, PDO::PARAM_STR);
    $statement->bindParam(':commentContent', $commentContent, PDO::PARAM_STR);
    $res = $statement->execute();
 
    header('Location: ../detail.php?id=' . $bookId);
    exit();
} catch (PDOException $e) {
    $_SESSION['errors'][]= 'コメントの投稿に失敗しました。';
    header('Location: ../detail.php?id=' . $bookId);
    exit();
}
