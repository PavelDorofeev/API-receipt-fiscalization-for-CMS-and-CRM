<?php 

$unic_id = mt_rand(); // Рандомное значение номера задания для KKT


/*
$BIT_X_REPORT = array( 	array(
	'name'=>'X отчет',
	'type'=>'kktXReport',
	'data'=>array(
		'cashierName_1021'=>'Третьякова-Филимоненко Марина Владимировна',
		'cashierInn_1203'=>'930300067715'
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
                    "productName_1030"=> "Отладка программы 1",
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
            "cashierName_1021"=> "Третьякова-Филимоненко Марина Владимировна",
            "cashierInn_1203"=> "930300067715",
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

//$encoded = json_encode( $postdata ,  JSON_PRETTY_PRINT ); так нельзя
$encoded = json_encode( $postdata ); // так ОК 
// все переносы, табуляции, русские символы экранируются , и все в одну строку получается





echo "<BR>\n len ".mb_strlen($encoded)." ".strlen($encoded)."
<BR>\n\n <pre>
".$encoded."
</pre>\n\n";


////"Content-type: application/x-www-form-urlencoded\r\n"   он сам добавляет
   $opts = array('http' =>
		array(
			 'method' => 'POST',
			 'header' => 
					   "Content-Length: " . mb_strlen($encoded) . "\r\n"
					  . "Action: command_list\r\n"
					  . "BIT_ENCODE_TYPE: PHP\r\n"
					  . "BIT_ORDER_ID: " . $unic_id . "\r\n"
					  . "BIT_KKT_TOKEN: 435cb88c28fc49bd419d58d4b60680b5\r\n", // atol 1.05
			 'content' =>  $encoded 
			 )
   );
   
   echo "len:".mb_strlen($encoded);
   
   echo "<br>";

   $context  = stream_context_create( $opts );
   
   $resStr = file_get_contents('http://109.188.142.134:44736', false, $context);

   echo "<pre>".$resStr."</pre>";
 
 
  var_dump( json_decode ( $resStr) );


?> 