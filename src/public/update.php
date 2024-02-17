<?php
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
    $dbUserName,
    $dbPassword
);

$id = filter_input(INPUT_POST, 'id');
$title = filter_input(INPUT_POST, 'title');
$impression = filter_input(INPUT_POST, 'impression');

// var_dump($id);
// var_dump($title);
// var_dump($content);

if (!empty($title) && !empty($impression)) {
    $sql = 'UPDATE books SET title=:title, impression=:impression WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':impression', $impression, PDO::PARAM_STR);
    $statement->execute();
    header('Location: ./index.php');
    exit();
}
$error = 'タイトルまたは感想が入力されていません';
?>

<body>
  <div>
    <p><?php echo $error . "\n"; ?></p>
    <a href="./index.php">
        <p>トップページへ</p>
    </a>
  </div>
</body>