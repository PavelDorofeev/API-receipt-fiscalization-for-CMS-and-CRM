
Файл paymentacceptance.zip лучше распаковать в папку /local/modules.

То есть должно получится так: /local/modules/paymentacceptance/...

Папка local обычно находится на одном уровне с папкой bitrix и upload.

Если папки /local/modules не существует, то ее можно создать.

Далее в надо в файле local\php_interface\init.php добавить подключение нашего модуля


//--------------------------------------------------------------------------------
Например так :

require_once( $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if( $request->isAdminSection())
{
	if( $request->getRequestedPage() == '/bitrix/admin/sale_order_view.php' )
		require_once( $_SERVER['DOCUMENT_ROOT'] . '/local/modules/paymentacceptance/autoload.php');
}

//--------------------------------------------------------------------------------

Теперь модуль paymentacceptance появится в админке битрикс в списке модулей
и его надо подключить (нажать кнопку).

Теперь открывая страницу заказа вы должны увидеть новый блок с кнопками Наличными и Банковской картой.

И еще, надо указать значения токенов кассового аппарата и банковского терминала на странице настройки модуля (в админке).
