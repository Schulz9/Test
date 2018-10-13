<?php
class Person{
	public FirstName;
	public LastName;
	public BirthDay;
}
//дати вводимо через генератор випадкових чисел
//дати від 01.01.70 по 31.12.99
$start_date="01-01-70";
$end_date="31-12-99";
// Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

//
for($i=1;$i<=30,$i++){
	$p = new Person();
	$p->FirstName = "FirstName"+$i;
	$p->LastName = "LastName"+$i;
    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    $birthday = date('d-m-y', $val);
	$p->BirthDay = $birthday;
	$pers[$i] = $p;
}
$input_age = fgets(STDIN);
for($i=1;$i<=30,$i++){
	$dif_date = strtotime("now") - strtotime($birthday);
	$year = floor($diff_date / (365*60*60*24));
	if ($year > $input_age){
		$p = $pers[$i];
		fwrite(STDOUT, "Ім'я :".$p->FirstName." День народження: ".$p->BirthDay."\n");
	}
}
?>