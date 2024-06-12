<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./user/signin.php');
    exit();
}

$error = $_SESSION['errors'] ?? '';
unset($_SESSION['errors']);

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
    $dbUserName,
    $dbPassword
);

$bookId = filter_input(INPUT_GET, 'id');

$sql = 'SELECT * FROM books WHERE id = :bookId';
$statement = $pdo->prepare($sql);
$statement->bindValue(':bookId', $bookId, PDO::PARAM_INT);
$statement->execute();
$book = $statement->fetch();

$sqlComments = "SELECT * FROM comments WHERE book_id = '$bookId' ORDER BY created_at DESC";
$statementComments = $pdo->prepare($sqlComments);
$statementComments->execute();
$commentsInfoList = $statementComments->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍詳細</title>
</head>
<h2>書籍詳細</h2>
<body>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
  <tr bgcolor="#dcdcdc">
        <th>タイトル</th>
        <th>感想</th>
        <th>作成日時</th>
  </tr>
  <tr bgcolor="#f5f5f5">
   <td><?php echo $book['title']; ?></td>
    <td><?php echo $book['impression']; ?></td>
    <td><?php echo $book['created_at']; ?></td> 
  </tr>
  </table>
  <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-white">
    <div class="flex-auto p-5 lg:p-10">
      <h4 class="text-2xl mb-4 text-black font-semibold">この投稿にコメントしますか？</h4>
      <form method="POST" action="comment/store.php" name="comment_form">
        <input type="hidden" name="book_id" value=<?php echo $bookId; ?>>
        コメント名：<input type="text" name="commenter_name" size="20">
        <br>
        コメント：
        <br>
        <textarea name="comment" rows="5" cols="30"></textarea>
        <br>
        <input type="submit" value="コメントする">
      </form>
    </div>
  </div>
      
  <h4 class="text-2xl mb-4 text-black font-semibold">コメント一覧</h4>
    <?php foreach ($commentsInfoList as $commentsInfo): ?>
    <div class="border-b-2 border-solid	py-2.5 text-black">
      <div class="relative w-full mb-3">
        <p class="mb-2.5 leading-tight text-xl break-all font-normal"><?= htmlspecialchars(
            $commentsInfo['comment']
        ) ?></p>
      </div>
      <div class="relative w-full mb-3">
        <p class="text-sm"><?= htmlspecialchars(
            $commentsInfo['created_at']
        ) ?></p>
        <p class="text-sm"><?= htmlspecialchars(
            $commentsInfo['commenter_name']
        ) ?></p>
      </div>
    </div>
    <?php endforeach; ?>
</body>
</html>