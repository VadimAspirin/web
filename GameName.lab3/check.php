<?php

$data = array(
	'id'=>'ivan',
	'name'=>'ivan1',
	'image'=>'ivan1',
	'power'=>'ivan1',
	'speed'=>'ivan2',
);

/*
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => 'http://localhost/php-server/GameName.lab3/?controller=pokemon',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data)
));
*/
/*
$ch = curl_init('http://localhost/php-server/GameName.lab3/?controller=pokemon&id=4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
*/

$ch = curl_init('http://localhost/php-server/GameName.lab3/?controller=pokemon&id=4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");



$response = curl_exec($ch);
curl_close($ch);

echo "Ответ на Ваш запрос: ".$response;
