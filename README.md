Рады представить АПИ БИТ драйвер ККТ вер 1.2 разработчикам облачных решений (для  разных CMS,CRM).
АПИ решает проблему с фискализацией чеков (из браузера) на локально подключенном к компьютеру оборудовании, а точнее на кассовых аппаратах (РФ, ФЗ54) моделей Атол и Меркурий и банковских терминалах (протокол Arcus). Этот режим мы называем - режим товароучетки.

Также с версии АПИ 1.1 и программы БИТ драйвер ККТ с версии 1.19 мы предоставляем возможность фискализировать чеки после оплаты покупателем в облаке автоматически, то есть без интерактивного участия продавца. Этот режим мы называем - режим оплаты в облаке. Это всем известные оплаты покупателем по данным банковской карты или по QR коду на вашем сайте. Здесь мы только предоставляем фискализацию чека вторым этапом.

В режиме товароучетки управление идет на localhost компьютера и команды выполняются мгновенно.

В режиме оплаты в облаке чек ставится в очередь на пробитие (на сервер kkmspb.ru). Есть механизм, позволяющий пробивать чек примерно сразу в течении 5-10 секунд с возвращением подробного результата фискализации, но для этого надо настроить роутер (пробросить порт 44735).

Чтобы понять как работает АПИ перейдите на страницу https://vspbkassa.ru/api/test.php , укажите несколько настроечных параметров и проверьте фискализацию чека и оплату по карте. По сути эта страница - готовый пример - как вы можете у себя на сайте взаимодействовать с нашим сервисом.

Чтобы реализовать механизм взаимодействия используйте АПИ протокол обмена, описанный в файле "АПИ БИТ драйвер ККТ для CMS вер.1.2.pdf".

Скачать тестовую страницу test.php (и необходимые к нем библиотеки jquery) можно здесь на гитхабе (каталоги css, js).

На сайте kkmspb.ru есть несколько видео [https://kkmspb.ru/software/BIT-driver-KKT/](https://kkmspb.ru/software/BIT-driver-KKT/) .
На ютюбе канал, посвященный БИТ драйвер ККТ : [https://www.youtube.com/playlist?list=PLUo21Uki3Ixq5vvvLdKQB9fYSz79_NTmw ](https://www.youtube.com/@kkmspb2).

Форум по БИТ драйвер ККТ [https://forum.kkmspb.ru](https://forum.kkmspb.ru/viewforum.php?f=1)

 
