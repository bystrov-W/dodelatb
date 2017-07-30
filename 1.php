<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
require_once 'connect.php'; // подключаем скрипт
 
if(isset($_POST['description']) && isset($_POST['Author'])){
 
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
     
    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['description']));
    $company = htmlentities(mysqli_real_escape_string($link, $_POST['Author']));
     
    // создание строки запроса
    $query ="INSERT INTO tasks VALUES(NULL, '$description','$Author')";
     
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<h2>Добавить новую модель</h2>
<form method="POST">
<p>Введите description:<br> 
<input type="text" name="description" /></p>
<p>АВТОР: <br> 
<input type="text" name="Author" /></p>
<input type="submit" value="Добавить">
</form>
</body>
</html>