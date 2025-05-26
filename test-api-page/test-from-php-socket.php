<?php 

$unic_id = mt_rand(); // Рандомное значение номера задания для KKT


/*
$BIT_X_REPORT = array( 	array(
	'name'=>'X отчет',
	'type'=>'kktXReport',
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>''
	)
	)
);
						   
$encoded = json_encode( $BIT_X_REPORT );						   
*/


$postdata = array( array(
        "name"=> "2. Фискализируем чек",
        "type"=> "kktReceiptFiscalization",
        "data"=> array(
            "1059"=> array(
                array(
                    "productName_1030"=> "Отладка программы 1 тестовая программа БИТ драйвер ктт",
                    "price_1079"=> 0,
                    "qty_1023"=> 1,
                    "amount_1043"=> 0,
                    "unit_2108"=> 0,
                    "paymentFormCode_1214"=> 4,
                    "productTypeCode_1212"=> 1,
                    "tax_1199"=> 6
                ),
				array(
                    "productName_1030"=> "Отладка программы 2",
                    "price_1079"=> 0,
                    "qty_1023"=> 1,
                    "amount_1043"=> 0,
                    "unit_2108"=> 0,
                    "paymentFormCode_1214"=> 4,
                    "productTypeCode_1212"=> 1,
                    "tax_1199"=> 6
                )
            ),
            "cashierName_1021"=> "Пупкин Иван Трофимович",
            "cashierInn_1203"=> "",
            "payments"=> array(
                "cash_1031"=> 0,
                "ecash_1081"=> 0,
                "prepayment_1215"=> 0,
                "credit_1216"=> 0,
                "barter_1217"=> 0
            ),
            "taxationType_1055"=> 1,
            "receiptType_1054"=> 1,
            "sendToEmail_1008"=> "kkmspb2008@yandex.ru",
            "printDoc"=> true
        )
	)
);

$CntType = "json";
//$CntType = "urlencoded";
//$CntType = "base64";
//$CntType = "hex";

if( $CntType == "json" )
{
	$ContentType = 'Content-Type: application/json; charset=UTF-8';
	//$encoded = json_encode( $postdata ,  JSON_PRETTY_PRINT ); так теперь можно тоже 
	$encoded = json_encode( $postdata , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // так теперь можно 
	//$encoded = json_encode( $postdata ); // так ОК  // все переносы, табуляции, русские символы экранируются , и все в одну строку получается
}
else if( $CntType == "urlencoded" )
{
	$ContentType = 'Content-Type: application/x-www-form-urlencoded';
	// сначала array в строку
	$encoded = json_encode( $postdata , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // так теперь можно 
	// потом строку еще кодируем
	$encoded = rawurlencode($encoded);
}
else if( $CntType == "base64" )
{
	$ContentType = 'Content-Type: text/plain base64';
	// сначала array в строку
	$encoded = json_encode( $postdata , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // так теперь можно 
	// потом строку еще кодируем
	$encoded = base64_encode($encoded);
}
else if( $CntType == "hex" )
{
	$ContentType = 'Content-Type: text/plain hex';
	// сначала array в строку
	$encoded = json_encode( $postdata , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // так теперь можно 
	// потом строку еще кодируем
	$encoded = bin2hex($encoded);
}

echo "<BR>\n len ".mb_strlen($encoded)." ".strlen($encoded)."
<BR>\n\n <pre>
".$encoded."
</pre>\n\n";

$address = '109.188.142.134';
$port = 44736;

if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) 
{
    //AF_INET - семейство протоколов
    //SOCK_STREAM - тип сокета
    //SOL_TCP - протокол
    echo "Ошибка создания сокета";
}
else 
{
	echo "Сокет создан\n";
}
$result = socket_connect($socket, $address, $port);

if ($result === false) 
{
	echo "Ошибка при подключении к сокету";
} 
else 
{
	echo "Подключение к сокету прошло успешно\n";
}

 
//Content-Type: application/json; charset=UTF-8
$msg = 'POST / HTTP/1.0
Host: 109.188.142.134:44736
'.$ContentType.'
Content-Length: '.mb_strlen($encoded).'
Action: command_list
BIT_ENCODE_TYPE: PHP
BIT_ORDER_ID: 1712661372
BIT_KKT_TOKEN: 435cb88c28fc49bd419d58d4b60680b5

'.$encoded;

echo "<br>Сообщение серверу: <pre>$msg</pre><br>\n";


socket_write($socket, $msg, strlen($msg)); //Отправляем серверу сообщение

$out = socket_read($socket, 1024); //Читаем сообщение от сервера

echo "Сообщение от сервера: <BR><pre>$out</pre><br>\n"; //Выводим сообщение от сервера


echo "Останавливаем работу с сокетом<br>\n";
//Останавливаем работу с сокетом
if (isset($socket)) 
{
	socket_close($socket);
	echo "Сокет успешно закрыт<br>";
}



?> 