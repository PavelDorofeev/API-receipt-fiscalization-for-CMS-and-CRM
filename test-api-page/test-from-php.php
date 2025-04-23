<?php

$unic_id = mt_rand();

$BIT_RECEIPT = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'p1_1059'=>
		array(
			'productName_1030'=>'Отладка программы ',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6,
			//'dsasa_1163'=>'4605817132102', // так не работает 
			/*'dsasa_1163'=> array( 
				'imcType_2100' => 3, 
				'imcModeProcessing_2102' => 0,  
				'itemEstimatedStatus_2003' => 1, 
				'imc_base64_2000' => 'MDEwNDYwMzU4NjAxNDY3NDIxNTAxMjUxNjY0MDI0Nx05MUVFMTAdOTJFQzlUUy8zQ2RyVHVPN001Kzluck5oeThvMHpxMkNIVjc0djdxdjc3K1BrPQ=='
			)*/
			//'dsasa_1162'=>'NDYwNTgxNzEzMjEwMg==' //4605817132102',
			//'ean13_1302'=>'4605817132102',
			//'gs_1163'=>'5432543254'
		),		
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
		'payments'=>[
					  'cash_1031'=>0,
					  'ecash_1081'=>0,
					  'prepayment_1215'=>0,
					  'credit_1216'=>0,
					  'barter_1217'=>0
					],
		'taxationType_1055'=>1,
		'receiptType_1054'=>1,
		'sendToEmail_1008'=>'flinks1986@gmail.com',
		'printDoc'=>true
	)
	)
];

$BIT_CLOSE_SHIFT = [ 
	array(
	'name'=>'Закрытие смены',
	'type'=>'kktCloseShift',
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>''
	)
	)
];

$BIT_OPEN_SHIFT = [ 
	array(
	'name'=>'Открытие смены',
	'type'=>'kktOpenShift',
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>''
	)
	)
];

$BIT_INCOM = [ 
	array(
	'name'=>'Внесение',
	'type'=>'kktСashIn',
	'sum'=>111.11,
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
	)
	)
];

$BIT_OUTCOM = [ 
	array(
	'name'=>'Внесение',
	'type'=>'kktСashOut',
	'sum'=>1.23,
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
	)
	)
];


$BIT_BNK_CARD = [
  array(
    "name"=> "1. Оплата по карте",
    "type"=>"bnkCardPayment",
    "data"=>array(
		"sum"=> 12
	)
  )
];


//$payload = json_encode( $BIT_OPEN_SHIFT );
//$payload = json_encode( $BIT_CLOSE_SHIFT );
//$payload = json_encode( $BIT_INCOM );
$payload = json_encode( $BIT_OUTCOM );
//$payload = json_encode( $BIT_RECEIPT );
//$payload = json_encode( $BIT_BNK_CARD );

echo "<BR>\n payload:".$arr." len:" .mb_strlen($payload)."<BR>\n";


$ch = curl_init(  'http://109.188.142.134:44736' );

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

curl_setopt( $ch, CURLOPT_POST, 1);

curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			//'Content-Length: '.mb_strlen($payload),
curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			//'Content-Type: application/json',
			'Action: command_list',
			'BIT_ENCODE_TYPE: PHP', 
			'BIT_ORDER_ID: 122',
			'BIT_KKT_TOKEN: ddf3cfc947c5fe3ee7ad96660c269e07',
			//'BIT_BNK_TRM_TOKEN: 7a6635341f95c54f4f6556c5940ed459',
			'Origin: https://kkmspb.ru'
        ) );

$result = curl_exec($ch);
curl_close($ch);

echo "<pre>$result</pre>";


/*
$BIT_RECEIPT = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'p1_1059'=>
		array(
			'productName_1030'=>'Отладка программы ',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),		
		'pp2_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp3_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp4_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp5_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp6_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp7_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp8_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),	
		'pp9_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp10_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp11_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp12_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp13_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp14_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),		
		'pp15_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp16_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp17_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp18_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp19_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp20_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'pp21_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
		'payments'=>[
					  'cash_1031'=>0,
					  'ecash_1081'=>0,
					  'prepayment_1215'=>0,
					  'credit_1216'=>0,
					  'barter_1217'=>0
					],
		'taxationType_1055'=>1,
		'receiptType_1054'=>1,
		'sendToEmail_1008'=>'flinks1986@gmail.com',
		'printDoc'=>true
	)
	)
];

$BIT_CLOSE_SHIFT = [ 
	array(
	'name'=>'Закрытие смены',
	'type'=>'kktCloseShift',
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>''
	)
	)
];

*/
?>

