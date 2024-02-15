<?php
$title = $_POST["title"];
$impression = $_POST["impression"];

$errors = [];
if (!empty($title) && !empty($impression)) {
  $dbUserName = 'root';
  $dbPassword = 'password';
  $pdo = new PDO(
    'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
    $dbUserName,
    $dbPassword
  );
  
  $stmt = $pdo->prepare("INSERT INTO books(
    title,impression
    ) VALUES (
      :title,:impression
    )");
  
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':impression',$impression,PDO::PARAM_STR);
    $res = $stmt->execute();
}

if (empty($title) || empty($impression)) {
  $errors[] = "タイトルまたは感想が入力されていません！";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>store.php</title>
</head>
<body>
  <div>
  <?php if (!empty($errors)):?>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error . "\n"; ?></p>
    <?php endforeach; ?>
    <a href="index.php">トップページへ</a>
  <?php endif; ?>

  <?php if (empty($errors)):?>
    <META http-equiv="Refresh" content="1; URL=index.php">
  <?php endif; ?>
  </div>
</body>
    
</html>