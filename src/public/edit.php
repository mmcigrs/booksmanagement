<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./user/signin.php');
    exit();
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
  $dbUserName,
  $dbPassword
);

$id = filter_input(INPUT_GET, 'id');

$sql = "SELECT * FROM books where id = $id";
$statement = $pdo->prepare($sql);
$statement->execute();
$page = $statement->fetch();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit.php</title>
</head>
<?php require_once './components/header.php'; ?>
<body>
  
  <h3>編集</h3>

  <form method="post" action="./update.php">

    <input type="hidden" name="id" value=<?php echo $page['id']; ?>>

    <div>
      <label for="title">タイトル<br>
        <input type="text" name="title" value=<?php echo $page['title']; ?>>
      </label>
    </div>

    <div>
      <br>
      <label for="impression">感想<br>
        <input type="text" name="impression" value=<?php echo $page['impression']; ?>>
      </label>
    </div>
    <br>
    <button type="submit">更新</button>
    
  </form>

</body>