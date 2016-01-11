<?php
	$filename=$_POST['filename'];
	if (file_exists($filename)) {
	    $xml = simplexml_load_file($filename);
	}
	else {
	    exit('Failed to open '.$filename);
	}
	$contentarr=array();
	$file="downloads/msql_phonebook.txt";
	foreach ($xml as $key => $value) {
	$content="ФИО :".$value->fio->lastname." ".$value->fio->firstname." ".$value->fio->surname."\r\n"
	."Телефон: ".$value->phone."\r\n"
	."Дата рождения: ".$value->birthdate->day.".".$value->birthdate->month.".".$value->birthdate->year."\r\n"
	."Адрес: ".$value->adress->country.", ".$value->adress->city."\r\n";
	$contentarr[]=$content;
	}
	$glue="\r\n";
	$dlcontent=implode ( $glue , $contentarr );
	file_put_contents($file, $dlcontent);
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"'); 
	header('Content-Length: ' . filesize($file));
	readfile($file);
?>
