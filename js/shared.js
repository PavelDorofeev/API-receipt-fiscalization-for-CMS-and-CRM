const dlg = { CLOSE: 'ошибка', SHOW: 'ОК' };
const res = { ERR: 'ошибка', OK: 'ОК' };
const rdr = { YES: 'СТРАНИЦА УСПЕШНОГО ЗАВЕРШЕНИЯ', NO: 'СТРАНИЦА С ОШИБКОЙ' , RELOAD:"ПЕРЕЗАГРУЗИТЬ СТРАНИЦУ"};

function closeDlg()
{
	//console.log(' closeDlg closeDlg')
	
	$( "#dlg123" ).dialog('close')
	
}
function aaaa( title = 'Ждите идет процесс..')
{
	//console.log('aaaa title:'+title)
	
	$( "#btnInfo" ).hide()
	
	$( "#rslt" ).text('')
	$( "#dlg123 div.spin_circle" ).show();
	
	$( "#dlg123").dialog('option', 'title', title)
	
	$( "#dlg123" ).dialog( "open" );
}

function dddd( title = 'Ждите идет процесс..' , data)
{
	$( "#info123").dialog('option', 'title', title )
	$( "#info_content").val(data)
	$( "#info123" ).dialog( "open" );
}

function bbbb( act , redir, result , txt , data='' , closeTime='2000')
{
	console.log(' bbbb act:'+ act +'   redir:'+redir + ' result:'+result)
	
	$( "#dlg123 div.spin_circle" ).hide();
	
	$( "#dlg123" ).dialog( "open" );
	
	err=''
	/*if( data["error"])
		err = data["error"]*/
	
	inf = data['info']
	
	console.log( 'bbbb data :'+ data)
	//console.log( 'bbbb info :'+ data["info"])
	
	// если text есть - это json экранированный значение, выводим как есть с переносами и т.д.
	/*printedText=''
	
	if( data["printedText"] != "" )
	{
		printedText = data["printedText"]
		delete data["printedText"]
		//console.log( printedText )
	}*/
	
	json = JSON.stringify( data , null , 2 )
	
	//console.log( 'bbbb json :'+ json)
	
	$( "#rslt" ).html(txt)
	
	$( "#dlg123" ).show();

	if(json!="")
	{
		$( "#rslt" ).append('<textarea type="hidden" id="json_res" name="json">'+ json +'</textarea>')
		$( "#btnInfo" ).show()
		$( "#rslt" ).show();
	}
	
	if( result == res.OK )
	{
		$( "#dlg123").dialog('option', 'title', 'УСПЕШНО!')
	
		if(json!="")
		{
			//$( "#rslt" ).append('<textarea type="hidden" id="json_res" name="json">'+ json +'</textarea>')
			$( "#json_res" ).hide()
		}

	}
	else if( result == res.ERR )
	{
		$( "#dlg123").dialog('option', 'title', 'ОШИБКА!')
		
		if(err!="")
			$( "#rslt" ).append('<p class="red">'+ err +'</p> ')
		
		// тут целый data выводим
		//$( "#rslt" ).append('<textarea type="hidden" id="json_res" name="json">'+ json +'</textarea>')
		$( "#json_res" ).hide()
		//$( "#btnInfo" ).show()
		//$( "#rslt" ).show();
	}

		

	if(redir == rdr.RELOAD)
	{
		//console.log(' bbbb redir: ' + redir )
		$('#dlg123').prop('rdr', window.location.href )
		
	}
	else if(redir == rdr.YES)
	{	
		//console.log(' bbbb redir: ' + redir )
		
		if( result == res.OK)
			$('#dlg123').prop('rdr', $('#BIT_CALLBACK_SUCCESS').val())
		else
			$('#dlg123').prop('rdr',$('#BIT_CALLBACK_FAILED').val())
		
		console.log(' redir == rdr.YES bbbb redir: ' + $('#dlg123').prop('rdr') )
		
		setTimeout( closeDlg , 1000 );
	}
	
	if(act == dlg.CLOSE)
	{
		//console.log(' bbbb closeDlg')
		
		setTimeout( closeDlg , closeTime );
	}
	
}
function init_dlg()
{
	console.log('init_dlg ' +$( "#dlg123" ))
	
	var max_height = $(window).height() - 100
	if( max_height > 600)
		height= 600
	else
		height= max_height
	
	var max_width = $(window).width() - 100
		
	if( max_width > 450)
		width= 450
	else
		width= max_width


	$( "#dlg123" ).dialog(
	{
		autoOpen: false,
		//height: 200,
		height: height,
		width: width,
		maxWidth: max_width,
		maxHeight: max_height,
		modal: true,
		show: 
		{
			effect: "blind",
			duration: 500
		},
		hide: 
		{
			effect: "explode",
			duration: 500
		},
		
		buttons: 
		{
			"Закрыть": function ()
			{ 
				$(this).dialog('close'); 
			}
		},
		close: function(event, ui)
		{
			//alert('$(this).prop(rdr) : '+ $(this).prop('rdr'))
			
			if( $(this).prop('rdr') ) 
			{				
				$(this).prop('action',$(this).prop('rdr' ) ) 
				$(this).submit();
			}
			else // 
			{
				//console.log( 'не переходим никуда	 : ')
			}

		}
	});
	
	$('#dlg123').dialog({dialogClass:'dlg123'});
	
	var max_height = $(window).height() - 100
	if( max_height > 800)
		height= 800
	else
		height= max_height
	
	var max_width = $(window).width() - 100
	
	
	if( max_width > 600)
		width= 600
	else
		width= max_width
	
	console.log('width:'+width )
	console.log('max_width:'+max_width )
	console.log('height:'+height )
	console.log('max_height:'+max_height )
	
	$( "#info123" ).dialog(
	{
		autoOpen: false,
		maxHeight: max_height,
		maxWidth: max_width,
		height: height,
		width: width,
		modal: true,
		show: 
		{
			effect: "blind",
			duration: 500
		},
		hide: 
		{
			effect: "explode",
			duration: 500
		},
		
		buttons: 
		[{
			text: "Закрыть",
			"class": 'cancelButtonClass',
			click: function() {
				$(this).dialog('close'); 
			}
		}],
		close: function(event, ui)
		{
			//alert('$(this).prop(rdr) : '+ $(this).prop('rdr'))
		}
	});
	
	$('#info123').dialog({dialogClass:'info123_css'});

	$('#btnInfo').click( function(e)
	{
		e.preventDefault();
		dddd('содержание', $('#json_res').val())
		//alert( $('#json_res').val())
		return false
	});	
};

function prepare_payments()
{
	var payments = {}
	
	if( $('#cash_summ').text()!="" )
		payments["cash_1031"] = parseFloat( $('#cash_summ').text())
	
	if( $('#ecash_summ').text()!="" )
		payments["ecash_1081"] = parseFloat( $('#ecash_summ').text())
		
	if( $('#prepayment_summ').text()!="" )
		payments["prepayment_1216"] = parseFloat( $('#prepayment_summ').text())
	
	if( $('#credit_summ').text()!="" )
		payments["credith_1217"] = parseFloat( $('#credit_summ').text())
	
	if( $('#consideration_summ').text()!="" )
		payments["consideration_1215"] = parseFloat( $('#consideration_summ').text())
	
	return payments	
}

function prepare_receipt(  )
{
	console.log('prepare_receipt')
	
	var props = checkProperties2( 'footer' )
	
	var items = []
	
	$('#tbl > div').each(function(index, dv_row) 
	{
		row_id = $(dv_row).attr('id');
		
		if( $(dv_row).attr('id') == '')
			return;
		
		//console.log('kkt["type"]'+kkt["type"])
		
	   items.push( addReceiptItem2( row_id ) )
	   
	});
	

	var dat ={}
	
	dat["purchases"] = items
	dat["props"] = props
	dat["appendInfo"] = appendInfo
	dat["payments"] = prepare_payments()
	
	return dat
}

function checkCorrectAnsw( jqXHR, status, data )
{
	//console.log('success')
	//console.log('jqXHR.readyState:'+jqXHR.readyState)
	//console.log('status:'+status)
	//console.log('jqXHR.statusText:'+jqXHR.statusText)
	
	if( data == null)
	{
		setTimeout( bbbb, 100, dlg.SHOW, rdr.NO, res.ERR, 'Ошибка: некорректный ответ: принятый тип не объект')
		return false;
	}
	else if( typeof(data) !== 'object')
	{
		setTimeout( bbbb, 100, dlg.SHOW, rdr.NO, res.ERR, 'Ошибка: некорректный ответ: принятый тип не объект')
		return false;
	}
	else if( ! data.hasOwnProperty("result") )
	{
		setTimeout( bbbb, 100, dlg.SHOW, rdr.NO, res.ERR, 'Ошибка: некорректный ответ: параметр result отсутствует' ,data )
		return false;
	}
	else
	{
		//console.log('data'+data+ ' ' +status + ' result:'+ data["result"] + ' '+ data["error"])
		
		if( data["result"] !== true)
		{
			if( ! data.hasOwnProperty("error"))
			{
				setTimeout( bbbb, 100, dlg.SHOW, rdr.NO, res.ERR, 'результат: не успешный, ошибка не идентифицирована:', data )
				return false;
			}
			else 
			{
				console.log('data '+JSON.stringify(data , null, 2))
				setTimeout( bbbb, 100, dlg.SHOW, rdr.NO, res.ERR, 'результат: не успешный!' , data)
			}
			return false;
		}
	}
	
	return true;
}

function return_cancel()
{
	aaaa('ОТМЕНА ПРОБИТИЯ ПОЛЬЗОВАТЕЛЕМ')

	json={"result":false, "error":"пробитие чека отмено пользователем"}
	//$( "#rslt" ).append('<textarea type="hidden" id="json_res" name="json">'+ json +'</textarea>')

	setTimeout(bbbb , 100, dlg.SHOW, rdr.YES, res.ERR, 'пробитие чека отмено пользователем!', json)
	//$('#dlg').prop('rdr',$('#BIT_CALLBACK_FAILED').val())
	//$('#dlg').show()
	
	console.log('return_cancel')
	
	//closeDlg()
}

$(document).ready(function()
{
	
	console.log('shared.js document.ready(..)')
	
	var dlg = $('<div id="dlg123"><div><div class="spin_circle" ><div>ждите</div></div> <div id="into"><p id="rslt"></p><div id="right"><button id="btnInfo">...</button></div> </div></div></div>');
	
	dlg.hide()
	
	$('body').append(dlg)
	
	var info123 = $('<div id="info123" class="w100 h100"><div class="w100 h100"><textarea id="info_content" class=""></textarea></div></div>');
	
	
	info123.hide()
	
	$('body').append(info123)
	
	//$( "#info123" ).resizable( "disable" )

	init_dlg();
	
	
});

function init_from_shared()
{
	//console.log('init_from_shared')
	
	$(".drop_down").click( function(e){
		
		console.log(' dropdown .click '+$(this).prop('id') )
		
        var $target = $(this);
        var $clone = $target.clone().removeAttr('id');
		
        $clone.val($target.val()).css(
		{
            overflow: "auto",
            position: 'absolute',
            'z-index': 999,
            left: $target.offset().left,
            top: $target.offset().top + $target.outerHeight(),
            width: $target.outerWidth()
        }).attr('size', $clone.find('option').length > 10 ? 10 : $clone.find('option').length).change(function() 
		{
            $target.val($clone.val());
        }).on('click blur keypress',function(e) 
		{
         if(e.type !== "keypress" || e.which === 13)
            $(this).remove();
        });
		
        $('body').append($clone);
		
        $clone.focus();
    });
};
