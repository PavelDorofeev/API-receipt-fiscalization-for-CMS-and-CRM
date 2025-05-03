<!DOCTYPE html>

<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=1.0">
	
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="0"/>

	<link rel="icon" href="/favicon/sova-120x120.svg" type="image/svg+xml" />

	<title>Тестируем php команды управления кассовым аппаратом</title>
	<meta name="description" content="Пробиваем чеки удаленно на кассовых аппаратах через АПИ в программе БИТ драйвер ККТ." />

</head>
<?php
$unic_id = mt_rand();

?>

<body>

	<div>
		<form method="GET">
			<button name="action" value="kktOpenShift"  type="submit">Открытие смены</button> 
			<button name="action" value="kktCloseShift" type="submit">Закрытие смены</button> </br>
			<button name="action" value="kktСashIn"     type="submit">Внесение</button> 
			<button name="action" value="kktСashOut"    type="submit">Изъятие</button> </br>
			<button name="action" value="kktReceiptFiscalization" type="submit">Чек</button> 
			<button name="action" value="kktReceiptFiscalization_big" type="submit">Чек (20 позиций)</button> 
			<button name="action" value="kktXReport"    type="submit">X отчет</button> </br>
			<input name="cnt" type="hidden" value="<?php echo $unic_id;?>"/>
		</form>
	</div>

<?php


$BIT_RECEIPT = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'1059'=>[
			array(
				'productName_1030'=>'Отладка программы ',
				'price_1079'=>1.23,
				'qty_1023'=>2.345,
				"amount_1043"=>2.88,
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
			)
		],		
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
		'payments'=>[
					  'cash_1031'=>2.88,
					  'ecash_1081'=>0,
					  'prepayment_1215'=>0,
					  'credit_1216'=>0,
					  'barter_1217'=>0
					],
		'taxationType_1055'=>1,
		'receiptType_1054'=>1,
		'sendToEmail_1008'=>'kkmspb2008@yandex.ru',
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

$BIT_X_REPORT = [ 
	array(
	'name'=>'X отчет',
	'type'=>'kktXReport',
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

if( $_GET["action"]=="kktOpenShift")
	$payload = json_encode( $BIT_OPEN_SHIFT );

else if( $_GET["action"]=="kktCloseShift")
	$payload = json_encode( $BIT_CLOSE_SHIFT );

else if( $_GET["action"]=="kktСashIn")
	$payload = json_encode( $BIT_INCOM );
	
else if( $_GET["action"]=="kktСashOut")
	$payload = json_encode( $BIT_OUTCOM );

else if( $_GET["action"]=="kktReceiptFiscalization")
	$payload = json_encode( $BIT_RECEIPT );

else if( $_GET["action"]=="kktReceiptFiscalization_big")
{
	$summ = addMorePurchases($BIT_RECEIPT[0]["data"]);
	//echo "$summ=".$summ;
	//echo "BIT_RECEIPT[payments][cash_1031]".$BIT_RECEIPT[0]["data"]["payments"]["cash_1031"];
	
	$BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] = $BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] + $summ ;
	
	$payload = json_encode( $BIT_RECEIPT );
	//echo "<BR>payload: <pre>" .json_encode($BIT_RECEIPT , JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)."</pre><BR>\n";
}

else if( $_GET["action"]=="kktXReport")
	$payload = json_encode( $BIT_X_REPORT );

//$payload = json_encode( $BIT_BNK_CARD );


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
			'BIT_KKT_TOKEN: ddf3cfc947c5fe3ee7ad96660c269e07', // атол 1.05 435cb88c28fc49bd419d58d4b60680b5  штрих 12d1ed895b8b5bc60137d68492e88017
			//'BIT_BNK_TRM_TOKEN: 7a6635341f95c54f4f6556c5940ed459',
			'Origin: https://kkmspb.ru'
        ) );

$result = curl_exec($ch);
curl_close($ch);

echo "
	<h2>Ответ</h2>
	<pre>$result</pre>";


echo "
	<h2>\n послали:</h2>
	<pre>" . json_encode( json_decode ( $payload , true ) , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)."</pre>";
?>

</body>
</html>

<?php

function addMorePurchases(&$data)
{
	
$big= array(
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
		array(
			'productName_1030'=>'Отладка программы',
			'price_1079'=>1,
			'qty_1023'=>1,
			"amount_1043"=>1,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		)
	);
		
	$summ=0;
	foreach( $big as  $vv)
	{
		$data["1059"][]=$vv;
		$summ = $summ + $vv["amount_1043"]; //  для штрихов
	}
	return $summ;

}


?>
