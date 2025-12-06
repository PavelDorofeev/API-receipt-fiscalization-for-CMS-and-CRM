<?php 

	

?>
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
<style>
button{
	margin:0.5em; 
	paddig:0.2em; 
}
</style>

<?php
$unic_id = mt_rand();
?>

<body style="width:100%">

	<h2>Вы можете посмотреть содержание этой php страницы здесь: <a href="https://github.com/PavelDorofeev/API-receipt-fiscalization-for-CMS-and-CRM/tree/master/test-api-page">на github.</a></h2>
<?php	

	$get="";
	parse_str( $_SERVER['QUERY_STRING'] , $get );
	if(isset($get['action']))
		unset($get['action']);
	//header("Location: );
	echo '
	<button><a href="'.$_SERVER['PHP_SELF'].'?'.http_build_query( $get ).'">на исходную</a></button>';
?>
	
	<div style="display:flex; flex-direction:row; width:100%;">
	
		<form method="GET" style="background-color: #99b0ac; width:49%; padding:1em;">
			<button name="action" value="kktOpenShift"  type="submit">Открытие смены</button> 
			<button name="action" value="kktCloseShift" type="submit">Закрытие смены</button>
			<button name="action" value="kktCashIn"     type="submit">Внесение</button> 
			<button name="action" value="kktCashOut"    type="submit">Изъятие</button> </br>
			<button name="action" value="kktReceiptFiscalization" type="submit">Чек</button> 
			<button name="action" value="kktReceiptFiscalization_M" type="submit">Чек с маркировкой ФФД 1.2 <br>разрешительный режим</button> 
			<button name="action" value="kktReceiptFiscalization_20" type="submit">Чек<br>(20 позиций)</button> 
			<button name="action" value="kktReceiptFiscalization_40" type="submit">Чек<br>(40 позиций)</button> 
			<button name="action" value="kktReceiptFiscalization_80" type="submit">Чек<br>(80 позиций)</button> 
			<button name="action" value="kktXReport"    type="submit">X отчет</button> </br>
			<button name="action" value="kktOpenCashDraw"    type="submit">открыть денежный ящик</button> </br>
			
			<label title="из лк на kkmspb.ru">токен ккт:
				<input name="BIT_KKT_TOKEN" value="<?php echo $_GET['BIT_KKT_TOKEN'];?>"  size="32"/> 
			</label></br>
			
			<input name="cnt" type="hidden" value="<?php echo $unic_id;?>"/>

			<label title="проверка КМ через ККТ/ФН/ОФД ИСМ">считайте код маркировки:
				<input name="KM" value="<?php echo $_GET['KM'];?>" type="text" placeholder="пока не работает"/> 
			</label>		
			<button name="action" value="kktCheckKM" type="submit">Отправить</button>
			</br>
			<div style="padding:0.5em;">
				<label title="всплывающее окно из программы БИТ драйвер ККТ">	показывать окно (с логом процесса) из программы БИТ драйвер ККТ
					<select name="showMode">
						<option value="4" <?php echo (($_GET["showMode"]=="4") ? "selected":""); ?>>никогда</option>
						<option value="2" <?php echo (($_GET["showMode"]=="2") ? "selected":""); ?>>когда ошибка</option>
						<option value="1" <?php echo (($_GET["showMode"]=="1") ? "selected":""); ?> >всегда показывать</option>
					</select>
				</label>
			</div>			
		</form>
		
		<hr>
		<form method="GET" style="background-color: #a198af; width:49%; padding:1em;">
			<label title="из лк на kkmspb.ru">токен банк.терминала:
				<input name="BIT_BNK_TRM_TOKEN" value="<?php echo '625dfdbcd9fb3adb35593a5d994f0604';//$_GET['BIT_BNK_TRM_TOKEN'];?>"  size="32"/> 
			</label></br>
			<label title="принять оплату,  сумма:">сумма:
				<input type="text" name="bnkSumma" value="10"  size="6"/> 
			</label>	
			<button name="action" value="bnkPayment"  type="submit">Оплата по банк.карте</button> 
			
			<input name="cnt" type="hidden" value="<?php echo $unic_id;?>"/>
			</br>
			<div style="padding:0.5em;">
				<label title="всплывающее окно из программы БИТ драйвер ККТ">	показывать окно (с логом процесса) из программы БИТ драйвер ККТ
					<select name="showMode">
						<option value="4" <?php echo (($_GET["showMode"]=="4") ? "selected":""); ?>>никогда</option>
						<option value="2" <?php echo (($_GET["showMode"]=="2") ? "selected":""); ?>>когда ошибка</option>
						<option value="1" <?php echo (($_GET["showMode"]=="1") ? "selected":""); ?> >всегда показывать</option>
					</select>
				</label>
			</div>
		</form>
	</div>

<?php

//phpinfo();

$BIT_RECEIPT = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'1261'=>[
		array(	
			'a_1262'=>'001',
			'b_1263'=>'25.07.2025',
			'c_1264'=>'001',
			'd_1265'=>'jkersgdhfk8349544'			
		)
		],
		'1059'=>[
			array(
				'productName_1030'=>'Отладка программы ',
				'price_1079'=>0,
				'qty_1023'=>1,
				"amount_1043"=>0,
				'unit_2108'=>0,
				'paymentFormCode_1214'=>4,
				'productTypeCode_1212'=>1,
				'tax_1199'=>6
							)
		],		
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
		'payments'=>[
					  'cash_1031'=>1000,
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

$BIT_RECEIPT_WITH_MARKING = [ 
	array(
	'name'=>'2. Фискализируем чек',
	'type'=>'kktReceiptFiscalization',
	'data'=>array(
		'1059'=>[
			array(
				'productName_1030'=>'Отладка программы ',
				'price_1079'=>0,
				'qty_1023'=>1,
				"amount_1043"=>0,
				'unit_2108'=>0,
				'paymentFormCode_1214'=>4,
				'productTypeCode_1212'=>1,
				'tax_1199'=>6,

				'imcType_2100'=> 256,
				'mrkcode_2000'=>'MDEwNDY0MDA3ODAxNjM3MjIxbWc1YTUxO1FIZzJzNx05MUZGRDAdOTJkR1Z6ZENWWlNOK09zTy9FNDcyQTVlb2J4eERlazZXeDNRdTNsN3UyK2c0PQ==',
				'imcModeProcessing_2102'=>0,
				'itemEstimatedStatus_2003'=>1,
				
				'industryInfo_1261'=>[ // надо передавать именно как список
					array( 
						'foivId_1262'=>'030', // Министерство промышленности и торговли Российской Федерации
						'foivDate_1263'=>'21.11.2023',
						'foidDocNumber_1264'=>'1944',
						// industryAttribute_1265 заполняем по результату проверки в честном знаке
						'industryAttribute_1265'=>'UUID=1b48ccb5-33fd-4683-b30c-90a8f3ab36ca&Time=1754567373328'
					)
				]
				
			)
		],		
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
		'payments'=>[
					  'cash_1031'=>1000,
					  'ecash_1081'=>0,
					  'prepayment_1215'=>0,
					  'credit_1216'=>0,
					  'barter_1217'=>0
					],
		'taxationType_1055'=>1,
		'receiptType_1054'=>1,
		'sendToEmail_1008'=>'kkmspb2008@yandex.ru',
		'printDoc'=>true,
		'timeZone_1011'=>4
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
	'type'=>'kktCashIn',
	'cashSum'=>111.11,
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>'',
	)
	)
];

$BIT_OUTCOM = [ 
	array(
	'name'=>'Внесение',
	'type'=>'kktCashOut',
	'cashSum'=>1.23,
	'data'=>array(
		'cashierName_1021'=>'Пупкин Иван Трофимович',
		'cashierInn_1203'=>''
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

$BIT_OPEN_CASH_DRAW = [ 
	array(
	'name'=>'открыть денежный ящик',
	'type'=>'kktOpenCashDraw',
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
		"sum"=> (($_GET["bnkSumma"]>0) ?  $_GET["bnkSumma"] : 12 )
	)
  )
];


if( $_GET["KM"] != "" )
{
	$cmd = [ 
	array(
	'name'=>'проверить код маркировки',
	'type'=>'kktCheckKM',
	'data'=>array(
		'km_2000'=> $_GET["KM"]
	)
	)
	];
	
	$arr = $cmd ;
}
else if( $_GET["action"]=="kktOpenShift")
	$arr = $BIT_OPEN_SHIFT ;

else if( $_GET["action"]=="kktCloseShift")
	$arr = $BIT_CLOSE_SHIFT ;

else if( $_GET["action"]=="kktCashIn")
	$arr = $BIT_INCOM ;
	
else if( $_GET["action"]=="kktCashOut")
	$arr = $BIT_OUTCOM ;

else if( $_GET["action"]=="kktReceiptFiscalization")
	$arr = $BIT_RECEIPT ;

else if( $_GET["action"]=="kktReceiptFiscalization_M")
	$arr = $BIT_RECEIPT_WITH_MARKING ;

else if( $_GET["action"]=="kktReceiptFiscalization_20")
{
	$summ = addMorePurchases($BIT_RECEIPT[0]["data"] , 20 , "наименование тестового товара 1235");
	
	$BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] = $BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] + $summ ;
	
	$arr =  $BIT_RECEIPT ;
}
else if( $_GET["action"]=="kktReceiptFiscalization_40")
{
	$summ = addMorePurchases($BIT_RECEIPT[0]["data"] , 40 , "Отладка Программы №1 Тест на длинные названия и большое количество артикулов. Отладка программы много позиций.");
	
	$BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] = $BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] + $summ ;
	
	$arr =  $BIT_RECEIPT;
}
else if( $_GET["action"]=="kktReceiptFiscalization_80")
{
	$summ = addMorePurchases($BIT_RECEIPT[0]["data"] , 80 , "Отладка Программы №1 Тест на длинные названия и большое количество артикулов. Отладка программы много позиций.");
	
	$BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] = $BIT_RECEIPT[0]["data"]["payments"]["cash_1031"] + $summ ;
	
	$arr =  $BIT_RECEIPT ;
}
else if( $_GET["action"]=="kktXReport")
	$arr =  $BIT_X_REPORT ;

else if( $_GET["action"]=="kktOpenCashDraw")
	$arr =  $BIT_OPEN_CASH_DRAW ;

else if( $_GET["action"]=="bnkPayment")
{
	$arr =  $BIT_BNK_CARD ;
}
else
{
	$arr = array();
}

// добавляем showMode если есть такой параметр
if( array_key_exists( "showMode" , $_GET ) )
{
	foreach( $arr as $kk => $vv)
	{
		$arr[$kk]["showMode"] = $_GET["showMode"]; // к каждой команде в пакете добавляем 
	}
}


$payload = json_encode( $arr );

$_SESSION["clear_action"]=1;  // очищаем action , чтобы при обновлении страницы не повторить опять это действие

if( count($arr)>0 && $payload != "")
{	
	//$payload = json_encode( $BIT_BNK_CARD );

	$ch = curl_init(  'http://95.161.41.82:44736' );

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

	curl_setopt( $ch, CURLOPT_POST, 1);

	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

				//'Content-Length: '.mb_strlen($payload),
	$BIT_KKT_TOKEN='';
	if( array_key_exists('BIT_KKT_TOKEN' , $_GET ) )
		$BIT_KKT_TOKEN= $_GET['BIT_KKT_TOKEN'];
		
	$BIT_BNK_TRM_TOKEN='';
	if( array_key_exists('BIT_BNK_TRM_TOKEN' , $_GET ) )
		$BIT_BNK_TRM_TOKEN= $_GET['BIT_BNK_TRM_TOKEN'];
		
			//'BIT_KKT_TOKEN: 16bba36069e6a91d4919fa64c9236f4e', //мерк
			//'BIT_KKT_TOKEN: 435cb88c28fc49bd419d58d4b60680b5', // атол 1.05 435cb88c28fc49bd419d58d4b60680b5  
			// ddf3cfc947c5fe3ee7ad96660c269e07', // атол 1.2
			// штрих 12d1ed895b8b5bc60137d68492e88017
			// атол 1.2 ddf3cfc947c5fe3ee7ad96660c269e07
	$headers = array(
				'Content-Type: application/json',
				'Action: command_list',
				'BIT_ENCODE_TYPE: PHP', 
				'BIT_ORDER_ID: 122',
				'BIT_ALLOW_INVALID_MRK_CODES_WITH_CASHIER: true',
				'BIT_KKT_TOKEN: '.$BIT_KKT_TOKEN, 
				'BIT_BNK_TRM_TOKEN: '.$BIT_BNK_TRM_TOKEN,
				'Origin: https://kkmspb.ru'
			) ;	

		
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close($ch);


	
	echo "
		<hr>
		<h2>Ответ</h2>
		<pre>$result</pre>";


	echo "
		<hr>
		<h2>Послали:</h2>
		<h3>заголовки:</h2>
		<pre>" . json_encode(  $headers  , JSON_PRETTY_PRINT)."</pre>
		<h3>тело:</h2>
		<pre>" . json_encode( json_decode ( $payload , true ) , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)."</pre>";
	
}	
?>

</body>
</html>

<?php

function addMorePurchases(&$data, $count, $productName)
{
	$item = array(
			'productName_1030'=>"$productName",
			'price_1079'=>0,
			'qty_1023'=>1,
			"amount_1043"=>0,
			'unit_2108'=>0,
			'paymentFormCode_1214'=>4,
			'productTypeCode_1212'=>1,
			'tax_1199'=>6
		);
	
	$big= array();

	for( $ii=0; $ii<$count; $ii++)
	{
		$big[] = $item;
	}
	
	
	$summ=0;
	foreach( $big as  $vv)
	{
		$data["1059"][]=$vv;
		$summ = $summ + $vv["amount_1043"]; //  для штрихов
	}
	return $summ;

}


?>
