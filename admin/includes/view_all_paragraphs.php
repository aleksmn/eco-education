<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) 
    die("Ошибка при подключении к базе данных: " . $conn->connect_error);
  // Для правильного потображения кодировки.
  $conn->query("SET NAMES 'utf8'");
?>

<p>Смотреть все параграфы</p>


<table>
<thead>
<tr>
  <th>Номер</th>
  <th>Название</th>
  <th>Абстракт</th>
  <th>Текст</th>
</tr>
</thead>
<tbody>
<?php

$query = "SELECT * FROM paragraphs ORDER by number";
$result = $conn->query($query);
if(!$result) die("Сбой при доступе к базе данных: " . $conn->error);



while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $id = $row['id'];
  $number = $row['number'];
  $title = $row['title'];
  $abstract = mb_substr($row['abstract'],0,300);
  $content = mb_substr($row['content'],0,300);

  echo "<tr>";
  echo "<td>{$number}</td>";
  echo "<td>{$title}</td>";
  echo "<td>{$abstract}</td>";
  echo "<td>{$content}</td>";
  echo "<td><a href='paragraphs.php?source=edit_paragraph&p_id={$id}'>Edit</a></td>";
  echo "<td><a href='paragraphs.php?delete={$id}'>Delete</a></td>";
  echo "</tr>";
}

?>
</tbody>
</table>

<ul>
  <li><a href='paragraphs.php?source=edit_paragraph'>Редактировать</a></li>
  <li><a href='paragraphs.php?source=add_paragraph'>Добавить</a></li>

</ul>


<?php

if(isset($_GET['delete'])){
  $query = "DELETE FROM paragraphs WHERE id = {$_GET['delete']}";
  $result = $conn->query($query);
  if(!$result) die("Сбой при удалении из базы данных: " . $conn->error);
  header("Location: paragraphs.php");
}

?>
