<!DOCTYPE html>
<link rel="icon" href="/favicon/sova-120x120.svg" type="image/png" />
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=1.0">
	<link rel="icon" href="/favicon/sova-120x120.svg" type="image/svg+xml" />

	<title>Программное обеспечение для автоматизации торговли</title>
	<meta name="description" content="Пробиваем чеки удаленно на кассовых аппаратах через АПИ  программе БИТ драйвер ККТ." />
	
	<script src="/api/js/jquery-3.2.1.js"></script>
	<script src="/api/js/jquery.md5.js"></script>


<style type="text/css">
	button{
		padding:0.5em;
		font-size:150%;
		margin:0.3em;
	}
	body{
		display:flex;
		flex-direction: column;
		justify-content: center;
		margin:auto;
		background: #c1d9c5;
	}
	h1{
		margin:auto;
	}
	input,select,option{
		font-size:inherit;
		padding:0.5em;
		border-radius:0.2em;
		margin-left: 1em;
	}
	
	label{
		display:flex;
		flex-direction:row;
		align-items:center;
		margin:0.3em;
		padding:0.3em;
	}
	.form1{
		display:flex;
		flex-direction: column;
		justify-content: center;
		margin:auto;
	}
</style>


<script>

$(document).ready(function()
{
	$('#btnSend').click(function(e) 
	{

		
		var BIT_SIGNATURE = $.md5( $('#BIT_ACCOUNT_ID').val() + 
		$('#BIT_KKT_TOKEN').val() + 
		$('#BIT_TRANSACTION_ID').val() + 
		$('#BIT_JSON').val()  + 
		$('#BIT_CALLBACK_SUCCESS').val() + 
		$('#BIT_CALLBACK_FAILED').val() + 
		$('#BIT_DATAINTEGRITY_CODE').val())
		
	
		val = $('#BIT_JSON').val()
		
		var btoaded = btoa( encodeURIComponent( val ) )
		
		$('#BIT_JSON').hide()
		$('#BIT_JSON').val(btoaded)
		
		$('#BIT_SIGNATURE').val(BIT_SIGNATURE)
		
		$('#form1').attr('action', 'https://kkmspb.ru/api/payment-dlg.php')
		
		$('#form1').submit();
		return false

	});
	
	$('#increment').click(function(e) 
	{
			
		var newVal = parseInt($('#BIT_TRANSACTION_ID').val()) + 1
		window.location.href = '/api/test.php?BIT_TRANSACTION_ID='+newVal+'&BIT_KKT_TOKEN='+$('#BIT_KKT_TOKEN').val()
		return false
		
	});

	$('#BIT_KKT_TOKEN').change(function(e) 
	{
			
		var BIT_TRANSACTION_ID = parseInt($('#BIT_TRANSACTION_ID').val()) 
		window.location.href = '/api/test.php?BIT_TRANSACTION_ID='+BIT_TRANSACTION_ID+'&BIT_KKT_TOKEN='+$('#BIT_KKT_TOKEN').val()
		return false
	});

	if( $('#BIT_TRANSACTION_ID').val() =='')
		$('#BIT_TRANSACTION_ID').val(1234)
	
		
		if( $('#BIT_KKT_TOKEN :selected').val()=="")
			$('#BIT_KKT_TOKEN').find('option[value=empty]').prop('selected', true)
		
		$('#BIT_JSON').val( JSON.stringify( BIT_JSON , null , 2))
});	

</script>	

</head>
<body>
	<h1>Ваша CMS/CRM</h1>
	
<?php 


$BIT_ACCOUNT_ID ="896";
$BIT_KKT_TOKEN = $_GET["BIT_KKT_TOKEN"]; //"d620cb5d4a0adb66838d20449f6ab370";
$BIT_TRANSACTION_ID = $_GET["BIT_TRANSACTION_ID"];
$BIT_DATAINTEGRITY_CODE="adasdsadsasdfgdsfsdasafsdfdsfdfa";


// здесь укажите уникальный номер вашего ккт (см. в личном кабинете kkmspb.ru)
$kkt = array(
"Меркурий"=>"d620cb5d4a0adb66838d20449f6ab370" , 
"как-то не корректный хэш ККТ"=>"543r34543543",
"Атол"=>"f039001210451fae2f18c2f6d75a5cc3");

echo "
		<label>
			BIT_DATAINTEGRITY_CODE : <input id=\"BIT_DATAINTEGRITY_CODE\" name=\"BIT_DATAINTEGRITY_CODE\" value=\"$BIT_DATAINTEGRITY_CODE\" />
		</label>";

echo "
	<form id=\"form1\" class=\"form1\"  action=\"https://kkmspb.ru/api/payment-dlg.php\" method=\"post\" >

		<label>
			BIT_ACCOUNT_ID : <input name=\"BIT_ACCOUNT_ID\" id=\"BIT_ACCOUNT_ID\" value=\"$BIT_ACCOUNT_ID\" />
		</label>
		
		<label>
			BIT_KKT_TOKEN :
			<select name=\"BIT_KKT_TOKEN\" id=\"BIT_KKT_TOKEN\">";
			
			foreach($kkt as $kk => $vv)
			{
				echo "
				<option value=\"$vv\" ".(( $vv == $BIT_KKT_TOKEN)?" selected":"")." >$kk</option>";
			}
		
			echo "
				<option value=\"empty\">выберите ккт</option>";
			
				
		echo "	</select>
		</label>
			
		<label>
			BIT_TRANSACTION_ID : <input id=\"BIT_TRANSACTION_ID\" name=\"BIT_TRANSACTION_ID\" value=\"$BIT_TRANSACTION_ID\" />
			<button id=\"increment\"> + </button>
		</label>
		
		
		<label>
			без печати на термоленте: <input name=\"without_receipt_on_paper\" type=\"checkbox\" checked/>
		</label>
		
		<label>
			BIT_CALLBACK_SUCCESS : <input id=\"BIT_CALLBACK_SUCCESS\" name=\"BIT_CALLBACK_SUCCESS\" value=\"http://kkmspb.ru/api/callback/success.php\" size=\"35\"/>
		</label>
		
		<label>
			BIT_CALLBACK_FAILED : <input id=\"BIT_CALLBACK_FAILED\" name=\"BIT_CALLBACK_FAILED\" value=\"http://kkmspb.ru/api/callback/failed.php\" size=\"35\"/>
		</label>
		
		<button id=\"btnSend\" style=\"background:#509b7f; color:#FFFFFF;\" type=\"submit\">
			Принять оплату с фисказацией чека
		</button>
		
		<label>
			BIT_SIGNATURE : <input id=\"BIT_SIGNATURE\" name=\"BIT_SIGNATURE\" value=\"\" placeholder=\"вычисляется непосредственно перед передачей\"/>
		</label>
		
			
		<div style=\"margin:1em;\">
			<textarea id=\"BIT_JSON\" name=\"BIT_JSON\" cols=\"75\" rows=\"40\"></textarea>
		</div>
		
	</form>
	
		
	<hr>
</div>
";
?>
<script type="text/javascript">
var BIT_JSON={	
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
		},
		{
			"productName_1030" : "товар 234",
			"price_1079" : 22.00,
			"qty_1023" : 1.00,
			"unit_2108" : 0,
			"paymentFormCode_1214" : 2,
			"productTypeCode_1212" : 3,
			"tax_1199" : 6
		}
	 ],
	"cashierName_1021": "Пупкин Иван Трофимович",
	"cashierInn_1203":"",
	"payments":{
		"cash_1031" : 11.00,
		"ecash_1081" : 2.00,
		"prepayment_1215" : 0,
		"credit_1216" : 0,
		"barter_1217" : 0
	},
	"taxationType_1055" : 5,
	"receiptType_1054" : 0
}
</script>

</body>
</html>"
<!--
			"countryOfOrigin_1230" : "RUS",
			"customsDeclaration_1231": "xx/yy/zzz",
			"exciseAmount_1229" : 3.44,
			"nomenclatureCode_1162" : "345435345565756",
		
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
