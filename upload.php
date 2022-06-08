<?php

declare(strict_types=1);

function goHome(): void
{
  header("Location: ./index.html");
}

if (isset($_POST["file_name"]) && empty($_POST["file_name"])) {
  goHome();
}

if (isset($_FILES["content"]) && (empty($_FILES["content"]["name"]) || $_FILES["content"]["error"])) {
  goHome();
}

$uploadDir = './upload';
if (is_writable($uploadDir)) {
  $uploadPath = $uploadDir . '/' . $_POST["file_name"];
  if (move_uploaded_file($_FILES['content']['tmp_name'], $uploadPath)) {
    echo 'Файл загружен' .  '<br />';
    echo 'Путь к файлу: ' . realpath($uploadDir) . '/' . $_POST["file_name"] . '<br />';
    echo 'Размер файла: ' . $_FILES['content']['size'] . '<br />';
  } else {
    echo 'Возникла ошибка во время загрузки файла!' . '<br />';
  }
} else {
  echo "Нет доступа к $uploadDir";
}

echo "<p><a href='index.php' style='text-decoration: none'>&#8592 Назад</a></p>";

//echo "<pre>";
//print_r($_POST);
//print_r($_FILES);
//echo "</pre>";
