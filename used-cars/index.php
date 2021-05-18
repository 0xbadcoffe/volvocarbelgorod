<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("Filter", "Цена,Год,Пробег,Тип двигателя,Привод,Цвет");
$APPLICATION->SetPageProperty("TopPager", "1311");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent("bitrix:news", "aval-3.2", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "auto",	// Тип инфоблока
		"IBLOCK_ID" => "47",	// Инфоблок
		"NEWS_COUNT" => "99",	// Количество новостей на странице
		"USE_SEARCH" => "N",	// Разрешить поиск
		"USE_RSS" => "N",	// Разрешить RSS
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_CATEGORIES" => "N",	// Выводить материалы по теме
		"USE_FILTER" => "Y",	// Показывать фильтр
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"LIST_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "AN_YER",
			1 => "AN_DVG",
			2 => "AN_IMG",
			3 => "AN_KUZ",
			4 => "AN_KOM",
			5 => "AN_LIT",
			6 => "AN_PRI",
			7 => "AN_PRO",
			8 => "AN_KMS",
			9 => "AN_DTP",
			10 => "AN_TRA",
			11 => "AN_COL",
			12 => "AN_PRC",
			13 => "AN_RUK",
			14 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DETAIL_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "AN_YER",
			1 => "AN_DVG",
			2 => "AN_IMG",
			3 => "AN_KUZ",
			4 => "AN_KOM",
			5 => "AN_LIT",
			6 => "AN_PRI",
			7 => "AN_PRO",
			8 => "AN_KMS",
			9 => "AN_DTP",
			10 => "AN_TRA",
			11 => "AN_COL",
			12 => "AN_PRC",
			13 => "AN_RUK",
			14 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
		"DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
		"DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"SEF_FOLDER" => "/used-cars/",	// Каталог ЧПУ (относительно корня сайта)
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"COMPONENT_TEMPLATE" => "aval-3.0",
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"FILTER_NAME" => "",	// Фильтр
		"FILTER_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(	// Свойства
			0 => "AN_YER",
			1 => "AN_DVG",
			2 => "AN_IMG",
			3 => "AN_KUZ",
			4 => "AN_KOM",
			5 => "AN_LIT",
			6 => "AN_PRI",
			7 => "AN_PRO",
			8 => "AN_KMS",
			9 => "AN_DTP",
			10 => "AN_TRA",
			11 => "AN_COL",
			12 => "AN_PRC",
			13 => "AN_RUK",
			14 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "/used-cars/",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>