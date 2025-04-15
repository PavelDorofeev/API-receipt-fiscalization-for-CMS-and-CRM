
function sendPost(url)
{
	console.log('url:'+url)
	
	var BIT_SIGNATURE = $.md5( $('#BIT_ACCOUNT_ID').val() + 
	$('#BIT_KKT_TOKEN').val() + 
	$('#BIT_ORDER_ID').val() + 
	$('#DATA').val()  + 
	$('#BIT_CALLBACK_SUCCESS').val() + 
	$('#BIT_CALLBACK_FAILED').val() + 
	$('#BIT_DATAINTEGRITY_CODE').val())
	

	val = $('#DATA').val()
	
	console.log('val'+val)
	var btoaded = btoa( encodeURIComponent( val ) )

	$('#BIT_DATA').val(btoaded)
	
	$('#BIT_SIGNATURE').val(BIT_SIGNATURE)
	
	if( $('#BIT_PROG_URL_APP').val() )
	{
		$('#BIT_PROG_URL').val( $('#BIT_PROG_URL_APP').val() )
	}
	
	$('#form1').attr('action', url )
	
	$('#form1').submit();
}

function sendCloseShift(url)
{
	console.log('url:'+url)
	
	var BIT_SIGNATURE = $.md5( $('#BIT_ACCOUNT_ID').val() + 
	$('#BIT_KKT_TOKEN').val() + 
	$('#BIT_ORDER_ID').val() + 
	$('#closeShift').val()  + 
	$('#BIT_CALLBACK_SUCCESS').val() + 
	$('#BIT_CALLBACK_FAILED').val() + 
	$('#BIT_DATAINTEGRITY_CODE').val())
	

	val = $('#DATA').val()
	
	console.log('val'+val)
	var btoaded = btoa( encodeURIComponent( val ) )

	$('#BIT_DATA').val(btoaded)
	
	$('#BIT_SIGNATURE').val(BIT_SIGNATURE)
	
	if( $('#BIT_PROG_URL_APP').val() )
	{
		$('#BIT_PROG_URL').val( $('#BIT_PROG_URL_APP').val() )
	}
	
	$('#form1').attr('action', url )
	
	$('#form1').submit();
}

function uuidv4()
 {
  return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
    (+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
  );
}

function toHexString(byteArray) 
{
  return Array.from(byteArray, function(byte) 
  {
    return ('0' + (byte & 0xFF).toString(16)).slice(-2);
	
  }).join('')
}

function sendAjaxJsonCommandsPacket( url , hhh , jsnStr , text)
{
	aaaa(text)

	jsnObj = encodeURIComponent( jsnStr );
	
	var ajaxFn = function () 
	{
		$.ajax(
		{
			url: url,
			method: 'POST',
			dataType: 'json',
			headers: hhh,
			data:jsnObj,
			async: false,
			
			error: function( jqXHR , status, errorMsg)
			{
				//aaaa('ошибка')
				
				if (jqXHR.readyState == 0) 
				{
				   setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, res.ERR, 'Network error, i.e.  server stopped, timeout, connection refused, CORS, etc.')
				}
				else if (jqXHR.readyState == 4) 
				{
				   setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, res.ERR, 'HTTP error, i.e. 404 Not found, Internal Server 500, etc.')
				}
				else
				{
					setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, res.ERR, 'Ошибка!')
				}
			},
			success: function(data , status , jqXHR)
			{
				//aaaa('ответ')
				
				/*if( ! checkCorrectAnsw (jqXHR, status, data ) )
					return*/
				rr=''
				if( data["result"] == false)
				{
					rr = data["error"]
					rslt = res.ERR
				}
				else
				{
					for ( var cmd in data )
					{
						console.log('cmd='+  cmd +' '+data[cmd])
						
						rslt = res.OK
						
						if( data[cmd]["error"])
						{
							rr += data[cmd]["name"] +' : '+data[cmd]["error"] +'<br>' 
							rslt = res.ERR
						}
						if (data[cmd]["success"])
							rr += data[cmd]["name"]+' : '+data[cmd]["success"] +'<br>'
						
					}
				}		
				setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, rslt, rr , data)
					
				
				/*if( data["result"] === false)
					setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, res.ERR, 'Ошибка оплаты картой!' , data)
				else
				{
					setTimeout(bbbb , 100, dlg.SHOW, rdr.NO, res.OK, 'Оплата картой прошла успешно' , data)
					
					if( $('#BIT_KKT_TOKEN').val() != "") // подключена касса
					{
						begin_check( $('#BIT_KKT_TOKEN').val() ,  $('#BIT_PROG_URL').val())
					}
					
				}*/
				
				//send_signal_to_execute_receipt( eqpt_hash , data["hash"] )
			}
		});
	}
	
	setTimeout( ajaxFn , 500);
}

$(document).ready(function()
{
	console.log('test.php document.ready')
	
	$('#BIT_DATA').hide()
	
	$('#btnCallPaymentDlg').click(function(e) 
	{
		sendPost ('https://kkmspb.ru/api/payment-dlg.php')
		return false
	});
	
	$('#btnSendReceipt').click(function(e) 
	{	
		console.log('btnSendReceipt click')
		e.preventDefault(false);
		
		var hhh = {}
		
		if( $('#BIT_BNK_TRM_TOKEN').val() != "")
		{
			hhh['BIT_BNK_TRM_TOKEN' ] =$('#BIT_BNK_TRM_TOKEN').val()
		}
		
		if( $('#BIT_KKT_TOKEN').val() != "")
		{
			hhh['BIT_KKT_TOKEN' ] =$('#BIT_KKT_TOKEN').val()
		}		
		
		if( $('#BIT_PROG_URL_APP').val() == "")
		{
			alert( 'не указан url куда посылат запрос')
			return
		}
		

		hhh['Action']='command_list'
		hhh['BIT_ORDER_ID']=$('#BIT_ORDER_ID').val()
		hhh['BIT_ENCODE_TYPE']='JS'
		
		var json = $('#RECEIPT').val()
		
		
		setTimeout( sendAjaxJsonCommandsPacket ,  100,  $('#BIT_PROG_URL_APP').val() ,  hhh , json )
		
		return false

	});	
	
	$('#btnBnkCard').click(function(e) 
	{	
		console.log('btnSendReceipt click')
		e.preventDefault(false);
		
		var hhh = {}
		
		if( $('#BIT_BNK_TRM_TOKEN').val() != "")
		{
			hhh['BIT_BNK_TRM_TOKEN' ] =$('#BIT_BNK_TRM_TOKEN').val()
		}
		
		if( $('#BIT_KKT_TOKEN').val() != "")
		{
			hhh['BIT_KKT_TOKEN' ] =$('#BIT_KKT_TOKEN').val()
		}		
		
		if( $('#BIT_PROG_URL_APP').val() == "")
		{
			alert( 'не указан url куда посылат запрос')
			return
		}
		

		hhh['Action']='command_list'
		hhh['BIT_ORDER_ID']=$('#BIT_ORDER_ID').val()
		hhh['BIT_ENCODE_TYPE']='JS'
		
		var json = $('#BNK_CARD').val()
		
		
		setTimeout( sendAjaxJsonCommandsPacket ,  100,  $('#BIT_PROG_URL_APP').val() ,  hhh , json )
		
		return false

	});		
	
	$('#btnKktOpenShift').click(function(e) 
	{	
		e.preventDefault(false);
		
		var hhh = {}
		
		hhh['BIT_KKT_TOKEN' ] =$('#BIT_KKT_TOKEN').val()
		
		hhh['Action']='command_list'
		hhh['Bit_order_id']=$('#BIT_ORDER_ID').val()
		hhh['BIT_ENCODE_TYPE']='JS'
		
		var json = JSON.stringify(kktOpenShift , null , 2);
		
		
		setTimeout( sendAjaxJsonCommandsPacket ,  100, 'http://localhost:44735' ,  hhh , json )
		
		return false
	});	
	
	$('#btnKktCloseShift').click(function(e) 
	{	
		e.preventDefault(false);
		
		var hhh = {}
		
		hhh['BIT_KKT_TOKEN' ] =$('#BIT_KKT_TOKEN').val()
		
		hhh['Action']='command_list'
		hhh['Bit_order_id']=$('#BIT_ORDER_ID').val()
		hhh['BIT_ENCODE_TYPE']='JS'
		
		var json = JSON.stringify(kktCloseShift , null , 2);
		
		
		setTimeout( sendAjaxJsonCommandsPacket ,  100, 'http://localhost:44735' ,  hhh , json )
		
		return false
	});	
	
	$('#btnFiscal').click(function(e) 
	{
		var BIT_SIGNATURE = $.md5( $('#BIT_ACCOUNT_ID').val() + 
		$('#BIT_KKT_TOKEN').val() + 
		$('#BIT_ORDER_ID').val() + 
		$('#RECEIPT').val()  + 
		$('#BIT_CALLBACK_SUCCESS').val() + 
		$('#BIT_CALLBACK_FAILED').val() + 
		$('#BIT_DATAINTEGRITY_CODE').val())
		
	
		val = $('#RECEIPT').val()
		
		var btoaded = btoa( encodeURIComponent( val ) )
		
		$('#BIT_DATA').hide()
		$('#BIT_DATA').val(btoaded)
		
		$('#BIT_SIGNATURE').val(BIT_SIGNATURE)
		
		if( $('#BIT_PROG_URL_CLOUD').val() )
		{
			$('#BIT_PROG_URL').val( $('#BIT_PROG_URL_CLOUD').val() )
		}
		
		$('#form1').attr('action', 'https://kkmspb.ru/api/create-receipt-dlg.php')
		
		$('#form1').submit();
		return false

	});
	
	$('#increment').click(function(e) 
	{
		//var newVal = parseInt($('#BIT_ORDER_ID').val()) +1
		var newVal = getRandomNumber(1, 1000000)
		$('#BIT_ORDER_ID').val(newVal ) 
		//window.location.href = '/api/test.php?BIT_ORDER_ID='+newVal+'&BIT_KKT_TOKEN='+$('#BIT_KKT_TOKEN').val()
		return false
		
	});
	

	
	$('#RECEIPT').val( JSON.stringify( RECEIPT , null , 2))
	
	$('#BNK_CARD').val( JSON.stringify( BNK_CARD , null , 2))
	
	var newVal = getRandomNumber(1, 1000000)
	$('#BIT_ORDER_ID').val(newVal ) 
	
	
});	

function getRandomNumber(min, max) 
{
    return parseInt( Math.random() * (max - min) + min)
}