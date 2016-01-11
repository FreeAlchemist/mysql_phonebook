<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel=Stylesheet href="msql_phonebook.css">
</head>
<body>
	
<?php
$filename="msql_phonebook.xml";

if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
}
else {
    exit('Failed to open '.$filename);
}
echo '<form method="post" action="msql_phonebook_download.php">';
echo '<input type="submit" value="Скачать">';
echo '<input type="hidden" name="filename" value="'.$filename.'">';
echo '</form>';

echo '<form method="get" action="msql_phonebook_form.php">';
echo '<input type="submit" value="Добавить контакт">';
echo '<input type="hidden" name="filename" value="'.$filename.'">';
echo '<input type="hidden" name="add" value="1">';
echo '</form>';

echo "<table rules=\"all\">";
	echo "<tr>
		<td>ФИО</td>
		<td>Телефон</td>
		<td>Дата рождения</td>
		<td>Адрес</td>
		</tr>";
foreach ($xml as $key => $value) {
	echo "<tr>";
	echo "<td>";
	echo "<a href=\"msql_phonebook_form.php?id=".$value['id']."&filename=".$filename."\">"
	    // .iconv("UTF-8","cp1251",$value->fio->lastname)." "
		.$value->fio->lastname." "
	    // .iconv("UTF-8","cp1251",$value->fio->firstname)." "
	    .$value->fio->firstname." "
	    // .iconv("UTF-8","cp1251",$value->fio->surname)."</a>";
	    .$value->fio->surname."</a>";
	echo "</td>";
	echo "<td>";
	echo $value->phone;
	echo "</td>";
	echo "<td>";
	// echo iconv("UTF-8","cp1251",$value->birthdate->day)."."
	// 	.iconv("UTF-8","cp1251",$value->birthdate->month)."."
	// 	.iconv("UTF-8","cp1251",$value->birthdate->year);
	echo $value->birthdate->day."."
		.$value->birthdate->month."."
		.$value->birthdate->year;
	echo "</td>";
	echo "<td>";
	// echo iconv("UTF-8","cp1251",$value->adress->country).", "
	// 	.iconv("UTF-8","cp1251",$value->adress->city);
	echo $value->adress->country.", "
		.$value->adress->city;	
	echo "</td>";
	echo "</tr>";
}
echo "</table>";


/*
$phonebook = mysql_connect("localhost","root","gfhjdjp");
or die (mysql_error());

mysql_select_db("phonebook",$phonebook);

$sql="
CREATE TABLE contacts
(
ID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(ID),
Lastname varchar(20),
Firstname varchar(20),
Surname varchar(20),
Phone int,
Birthdate date,
Country varchar(20),
City varchar(20)
)
";

mysql_query($sql, $phonebook);

$sql="
INSERT INTO contacts (Lastname, Firstname, Surname, Phone, Birthdate, Country, City) VALUES ('Петров','Иван','Сидорович','89995557755','1988.07.13','Россия','Ленинград')
";

mysql_query($sql, $phonebook);

$sql="
SELECT * FROM contacts
";
$result=mysql_query($sql, $phonebook);

while ($row=mysql_fetch_array($result)){
	$lastname=$row['Lastname'];
	$firstname=$row['Firstname'];
	echo $lastname." c именем ".$firstname."<br>";
}


*/
?>
</body>
