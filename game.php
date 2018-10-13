<?php
$generate_number = rand(1,30);
#count = 0;

do{
    echo "Enter you number\n\r";
    $input_number = fgets(STDIN);

    echo "Was input:".$input_number."\n\r";
    $count++;
    if ($generate_number < $input_number) $out = "Число більше";
    if ($generate_number > $input_number) $out = "Число менше";
    echo $out."\n\r";
}while ($generate_number != $input_number);
echo "Задумане число ".$generate_number."\n\r";
echo "Кількість спроб ".$count."\n\r";
?>