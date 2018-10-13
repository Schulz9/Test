<html>
<head>
  <title>Результат загрузки файла</title>
</head>
<body>
<?php
	set_time_limit(6000);
	ini_set('memory_limit', '128M');
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
	  //move_uploaded_file($_FILES["filename"]["tmp_name"], "\\tmp\\".$_FILES["filename"]["name"]);
	  echo $_FILES["filename"]["tmp_name"].'<br>';
	  echo $_FILES["filename"]["name"].'<br>';
      echo("Загрузка прошла успешно<br>");
//----------------------------------------
  // Попытка установить соединение с MySQL:
  $lnk = mysql_connect('base','root','');
    mysql_query ("SET NAMES utf8");
  // Соединились, теперь выбираем базу данных:
	mysql_select_db ('tables', $lnk) or die (mysql_error());
	  //------------------------------------------------------------
$handle = fopen($_FILES["filename"]["tmp_name"], "r");
$row = 1;
//$i=0;
array $title;
while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {

$uid = $data[0];
$firstName = $data[1];
$lastName = $data[2];
$birthDay = $data[3];
$dateChange = $data[4];
$description = $data[5];
$title[]=$uid;

$request = mysql_query("SELECT * FROM Person WHERE $uid = `uid`");
$count   = mysql_num_rows($request);
while ($row = mysql_fetch_assoc($request)){
  //якщо dateChange інакший - оновлюємо запис
  if ($dateChange!=$row['dateChange']) mysql_query("UPDATE Person SET `firstName`=$firstName, `lastName`=$lastName, 
  `birthDay`=$birthDay, `dateChange`=$dateChange, `description`=$description WHERE `uid`=$uid");
}
//якщо запис відсутній - вносимо
if ($count =0){
mysql_query("INSERT INTO Person (`uid`, `firstName`, `lastName`, `birthDay`, `dateChange`, `description`) VALUES ($uid, $firstName, $lastName,
$birthDay, $dateChange, $description)");
  }
}

//якщо даних нема в новому csv - видаляємо запис
$request = mysql_query("SELECT `uid` FROM Person);
while ($row = mysql_fetch_assoc($request)){
  $uid = $row['uid'];
  if !array_search($uid,$title) mysql_query("DELETE FROM Person WHERE `uid`=$uid);
  };
mysql_close();
   } else {
      echo("Ошибка загрузки файла");
   }
?>
</body>
</html>