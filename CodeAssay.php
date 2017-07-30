<?php
mb_internal_encoding('UTF8');
header( 'Content-Type: text/html; charset=utf-8' );



$mysqli = new mysqli("127.0.0.1", "root", "", "todo01");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
    !$mysqli->query("CREATE TABLE test(id INT)") ||
    !$mysqli->query("INSERT INTO test(id) VALUES (1)")) {
    echo "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
}

// выполняем операции с базой данных
$query ="SELECT * FROM tasks";
$result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli)); 
if($result)
{
    echo "Выполнение запроса прошло успешно";
}

?>

    
    





<h1>Список дел на сегодня</h1>
<div style="float: left">
    <form method="POST">
        <input type="text" name="description" placeholder="Описание задачи" value="" />
        <input type="submit" name="save" value="Добавить" />
    </form>
</div>
<div style="float: left; margin-left: 20px;">
    <form method="POST">
        <label for="sort">Сортировать по:</label>
        <select name="sort_by">
            <option value="date_created">Дате добавления</option>
            <option value="is_done">Статусу</option>
            <option value="description">Описанию</option>
        </select>
        <input type="submit" name="sort" value="Отсортировать" />
    </form>
</div>
<div style="clear: both"></div>

<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
    </tr>
<tr>
  <td>тест</td>
  <td>2017-06-07 22:09:33</td>
  <td><span style='color: green;'>Выполнено</span></td>
  <td>
        <a href='?id=342&action=edit'>Изменить</a>
        <a href='?id=342&action=done'>Выполнить</a>
        <a href='?id=342&action=delete'>Удалить</a>
    </td>
</tr>
</table>

<h1>Добавить новую задачу</h1>
<form action="Codeassay.php" method="GET">
<p>Введите номер:<br> 
<input type="int" name="$id" /></p>

<p>Введите описание:<br> 
<input type="text" name="$description" /></p>

<p>Введите свое имя: <br> 
<input type="text" name="$Author" /></p>

<input type="submit" value="Добавить">
</form>


<?php
if(isset($_GET['id']) && isset($_GET['description']) && isset($_GET['Author'])){

    $query2 ="INSERT INTO tasks VALUES ($id, '$description','$Author') ";
  
    // выполняем запрос
$result = mysqli_query($mysqli, $query2) or die("Ошибка " . mysqli_error($mysqli)); 
if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
}




?>







   
    <table border='1'>
    <?php
    while($row_rs = mysqli_fetch_assoc($result)) // массив с данными
    {
    ?>
        <tr>
    <?php
        foreach($row_rs as $val) //перебор массива в цикле
        {
 
            echo "<td>".$val."</td>"; //вывод данных
               
        }
    ?>
        </tr>
 
    
 
</table>


 <style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    
    table th {
        background: #eee;
    }
</style>

<?php }?>