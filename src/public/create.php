<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./user/signin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍登録フォーム</title>
</head>
<?php require_once './components/header.php'; ?>
<h3>書籍登録</h3>
<body>
 <form action="store.php" method="post">
    <div>
      <label for="title">タイトル</label><br>
      <input type="text" name="title" />
    </div>
    <div>
      <br>
      <label for="impression">感想</label><br>
      <input type="text" name="impression" />
    </div>
      <br>
      <button location.href="store.php">登録</button>
  </form>
</body>

</html>