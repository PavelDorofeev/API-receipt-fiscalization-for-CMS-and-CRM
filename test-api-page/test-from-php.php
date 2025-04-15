<?php

$unic_id = mt_rand();

$BIT_RECEIPT = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'pp_1059'=>
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>1.0,
			'qty_1023'=>1,
			"amount_1043"=>1.0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		),
		'cashierName_1021'=>'Третьякова-Филимоненко Марина Владимировна',
		'cashierInn_1203'=>'930300067715',
		'payments'=>[
					  'cash_1031'=>1,
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
		'cashierName_1021'=>'Третьякова-Филимоненко Марина Владимировна',
		'cashierInn_1203'=>'930300067715'
	)
	)
];

$BIT_OPEN_SHIFT = [ 
	array(
	'name'=>'Открытие смены',
	'type'=>'kktOpenShift',
	'data'=>array(
		'cashierName_1021'=>'Третьякова-Филимоненко Марина Владимировна',
		'cashierInn_1203'=>'930300067715'
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


$payload = json_encode( $BIT_OPEN_SHIFT );
$payload = json_encode( $BIT_CLOSE_SHIFT );
$payload = json_encode( $BIT_RECEIPT );
$payload = json_encode( $BIT_BNK_CARD );

echo "<BR>\n payload:".$arr." len:" .strlen($payload)."<BR>\n";


$ch = curl_init(  'http://109.188.142.134:44736' );

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

curl_setopt( $ch, CURLOPT_POST, 1);

curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: '.mb_strlen($payload),
			'Action: command_list',
			'BIT_ENCODE_TYPE: PHP', 
			'BIT_ORDER_ID: 122',
			'BIT_KKT_TOKEN: ddf3cfc947c5fe3ee7ad96660c269e07',
			'BIT_BNK_TRM_TOKEN: 7a6635341f95c54f4f6556c5940ed459',
			'Origin: https://kkmspb.ru'
        ) );

$result = curl_exec($ch);
curl_close($ch);

echo "<pre>$result</pre>";


?>