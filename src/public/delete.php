<?php
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
  $dbUserName,
  $dbPassword
);

$id = filter_input(INPUT_GET, 'id');

$sql = 'DELETE FROM books WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->execute();
header('Location: ./index.php');

?>