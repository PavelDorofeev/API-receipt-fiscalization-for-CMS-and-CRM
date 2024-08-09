<!DOCTYPE html>
<!-- <link rel="icon" href="/favicon/sova-120x120.svg" type="image/png" /> -->
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=1.0">
	<link rel="icon" href="/favicon/sova-120x120.svg" type="image/svg+xml" />

	<title>Программное обеспечение для автоматизации торговли</title>
	<meta name="description" content="Пробиваем чеки удаленно на кассовых аппаратах через АПИ  программе БИТ драйвер ККТ." />
	
	<link rel="stylesheet" type="text/css" href="/api/css/shared.css?1d335" />
	
	<!--<script src="/api/js/jquery-3.2.1.js"></script> -->
	<script src="/api/js/jquery.md5.js"></script>
	<script src="/api/js/jquery-3.7.1.js"></script>

	<script src="/api/js/jquery-ui.js"></script>

	<script src="/api/js/shared.js"></script>
	<script src="/api/js/general.js"></script>



</head>
<body>
<div id="wrapper">
	<h1>Ваша CMS/CRM</h1>
	
<?php 


$BIT_ACCOUNT_ID ="950";

$BIT_KKT_TOKEN = "3a5c770d7e36c94a6d58d1f7153bd485"; // по умолчанию
$BIT_KKT_TOKEN = "c751398cbf6f97b912050906923da1d6"; // по умолчанию

//$BIT_ORDER_ID = $_GET["BIT_ORDER_ID"];

$BIT_DATAINTEGRITY_CODE="GSDFHAGASHDGFHSADGFHSDGFDASHFDSA";

$BIT_BNK_TRM_TOKEN = '2bb9bbe5a103c897a4896cab18c394ae';

//$BIT_BNK_TRM_SUM = 11.00;

$host="vspbkassa.ru";

/*
//target="_blank" 
			<button id="btnCallPaymentDlg" style="background:#509b7f; color:#FFFFFF;">
				с переходом на сайт kkmspb.ru
			</button>
			
		<div class="mha m1 div1 p1">
		
			<h2>фискализация чека (режим оплата в облаке)</h2>
			
			<label>
				BIT_PROG_URL:<input id="BIT_PROG_URL_CLOUD" value="https://109.188.142.134:44735" size="38" />
			</label>
			
			<input type="hidden" name="BIT_PROG_URL" id="BIT_PROG_URL" value=""  />
			
			<button id="btnFiscal" style="background:#509b7f; color:#FFFFFF;" type="submit">
				с переходом на сайт kkmspb.ru
			</button>
		</div>

			<label>
				BIT_BNK_TRM_SUM:<input id="BIT_BNK_TRM_SUM" value="'.$BIT_BNK_TRM_SUM.'" />
			</label>
			
*/
echo '
<div id="wrapper2">
	
	<div class="div_json">
		<h2 class="m0 p0">пакет команд АПИ 1.2</h2>
		<textarea id="DATA" cols="30" rows="30"></textarea>
	</div>
	
	<form id="form1" class="form1"  action="https://'.$host.'/api/payment-dlg.php" method="post" >

		<h2>БИТ драйвер ККТ вер.1.21.2</h2>
		<div class="m1 div1 p1 m0">
		
			<h2>Принять оплату (режим товароучетка)</h2>
			
			<button id="btnSendJsonPacket" class="whiteOnBlue">
				выполнить
			</button>		
		</div>
		
		
		<div class="grd2auto p1 grGap05 m0 bcAAA br05">
			
			<label>
				BIT_KKT_TOKEN :
			</label>
			<input name="BIT_KKT_TOKEN" id="BIT_KKT_TOKEN" value="'.$BIT_KKT_TOKEN.'" />
			
			
			<label>
				BIT_BNK_TRM_TOKEN:
			</label>
			<input name="BIT_BNK_TRM_TOKEN" id="BIT_BNK_TRM_TOKEN" value="'.$BIT_BNK_TRM_TOKEN.'" />
			
				
			<label>
				BIT_ORDER_ID : 
			</label>
			<div class="flRow">
				<input id="BIT_ORDER_ID" name="BIT_ORDER_ID" value="$BIT_ORDER_ID" />
				<button id="increment" class="whiteOnBlue"> + </button>
			</div>
			
			<label>
				BIT_PROG_URL:
			</label>
			<input id="BIT_PROG_URL_APP" value="http://localhost:44735" />
			
		
		
			
		</div>
		
		<div style="margin:1em;">
			<textarea type="hidden" id="BIT_DATA" name="BIT_DATA" cols="75" rows="40"></textarea>
		</div>
			
		
	</form>
</div>		
	<hr>
	<div class="grd2auto p1 grGap05 m0 bcAAA br05">
	
		<div>Наш открытый проект на гитхабе:</div>
		<a  target=_blank href="https://github.com/PavelDorofeev/API-receipt-fiscalization-for-CMS-and-CRM">АПИ драйвер ККТ с примерами</a>
		
		<div>Войти личный кабинет : </div>
		<a target=_blank href="https://kkmspb.ru/me/">для настройки связи с кассовым аппаратом</a>
		
		<div>Скачать приложение под Windows :</div>
		<a target=_blank href="https://kkmspb.ru/software/BIT-driver-KKT/download/">БИТ драйвер ККТ</a>
	</div>
</div>';

/*
			<label>
				BIT_ACCOUNT_ID :
			</label>
			<input name="BIT_ACCOUNT_ID" id="BIT_ACCOUNT_ID" value="'.$BIT_ACCOUNT_ID.'" />


			<label>
				BIT_CALLBACK_SUCCESS :
			</label>
			<input id="BIT_CALLBACK_SUCCESS" name="BIT_CALLBACK_SUCCESS" value="https://'.$host.'/api/callback/success.php" size="38"/>
			
			
			<label>
				BIT_CALLBACK_FAILED : 
			</label>
				<input id="BIT_CALLBACK_FAILED" name="BIT_CALLBACK_FAILED"value="https://'.$host.'/api/callback/failed.php" size="38"/>
			
			<label>
				BIT_SIGNATURE : 
			</label>				
			<input type="text" id="BIT_SIGNATURE" name="BIT_SIGNATURE" value="" placeholder="вычисляется перед передачей"/>
			
			<label>
				BIT_DATAINTEGRITY_CODE : 
			</label>
			<input id="BIT_DATAINTEGRITY_CODE" name="BIT_DATAINTEGRITY_CODE" value="'.$BIT_DATAINTEGRITY_CODE.'" />


*/

?>

<! -- 
	Почему мы используем в json сначала всегда список (массив) [] : дело в том, что на стороне сервера (программа БИТ драйвер ККТ)
	когда мы распарсим строку в QMap или std::map мы получим другой порядок (упорядочивание оп ключу)
-->
<script type="text/javascript">
var DATA=[
	{
		"name":"1. Оплата по 'карте'",
		"type":"bnkCardPayment",
		"data": 
		{
			"sum":12
		}
	},
	{
		"name":"2. Фискализируем чек",
		"type":"kktReceiptFiscalization",
		"data": 
		{
			"purchases":
			[
				{
					"productName_1030" : "товар 123",
					"price_1079" : 11.00,
					"qty_1023" : 1.00,
					"unit_2108" : 10,
					"paymentFormCode_1214" : 2,
					"productTypeCode_1212" : 3,
					"tax_1199" : 6,
				
					"additionalAttribut_1191":"что-то дополнительное"
				}
			 ],
			"cashierName_1021": "Пупкин Иван Трофимович",
			"cashierInn_1203":"",
			"payments":{
				"cash_1031" : 10.00,
				"ecash_1081" : 1.00,
				"prepayment_1215" : 0,
				"credit_1216" : 0,
				"barter_1217" : 0
			},
			"taxationType_1055" : 5,
			"receiptType_1054" : 1,
			"sendToEmail_1008" : "kkmspb2008@yandex.ru",
			"printDoc":true
		}
	}
]
</script>
</div>

</body>
</html>

<!--
			
			"countryOfOrigin_1230" : "RUS",
			"customsDeclaration_1231": "11/141117/0004455",
			"nomenclatureCode_1162" : "345435345565756",
			"exciseAmount_1229" : 3.44,
			
		
	"clientInfo": 
	{
		"email_1008" : "kkmspb2008@yandex.ru",
		"name_1227" : "Bdfy Gegrby",
		"inn_1228" : "7826152874",
		"birthDate_1243" : "1970-01-01",
		"citizenship_1244" : "051",
		"identityDocumentCode_1245" : "GG",
		"identityDocumentData_1246" : "xxxx yyyyyy",
		"address_1254" : "Кудыкина Гора"
	},
	атоловский вариант	1.05 ( ожидается array !)
	"foiv":
	{
		"idFOIV_1262": "001",
		"foivDocDate_1263": "14.12.2018",
		"foivDocNum_1264": "003",
		"foivValue_1265": "tm=mdlp&sid=00000000105200"
	},
			"agent" : 
			{
				"agentCode_1222": 5,
				"payingOp_1044": "оп. №123",
				"payingPhone_1073": "+712345678",
				"operatorPhone_1074": "+712345678",
				"supplierPhone_1171": "+712345678",
				"supplierINN_1226": "7878787878",
				"supplierName_1225": "ООО ромашка",
				"transfName_1026": "ООО Оператор123",
				"transfINN_1016": "7878787878",
				"transfAddress_1005": "адрес бла бла бла",
				"transfPhone_1075": "+712345678"
			}
			"markirovka" :
			{
				"markingCode_2000": "MDEwMTIzNDU2Nzg5MDEyMzIxTSw3YUwwSkRHYkpDV2EdOTE4MDhCHTkyQ3VFMmI0d0JoUHY5WGVvQlFERXV4OXdPS2VOUjR2ZjRJK3EvUWJocXpoUkd5WVF5bWtrcGd0QVpVdFBIbGZwMFRIR1ZONmkrRDhaeFpRY2JUbnZFTWc9PQ==",
				"processingMode_2102":0,
				"plannedStatus_2003": 1,
				"part_1291": "1/10"
			},
-->

