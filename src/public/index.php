<?php
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
  $dbUserName,
  $dbPassword
);

$sql = "SELECT * FROM books";
$sth = $pdo -> query($sql);
$aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモ一覧</title>
</head>
<h2>メモ一覧</h2>
<a href="create.php">メモを追加</a>
<body>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
  <tr bgcolor="#dcdcdc">
        <th>タイトル</th>
        <th>感想</th>
        <th>作成日時</th>
        <th>編集</th>
        <th>削除</th>
  </tr>
  <?php foreach ($aryList as $key => $val) : ?>
    <tr bgcolor="#f5f5f5">
      <td><?php echo $val["title"]; ?></td>
      <td><?php echo $val["impression"]; ?></td>
      <td><?php echo $val["created_at"]; ?></td>
      <td><a href="./edit.php?id=<?php echo $val['id']; ?>">編集</a></td>
      <td><a href="./delete.php?id=<?php echo $val['id']; ?>">削除</a></td>
    </tr>
  <?php endforeach; ?>
</table>
</body>
</html>