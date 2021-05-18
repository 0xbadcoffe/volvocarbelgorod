<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TopPager", "1214");
$APPLICATION->SetTitle("Title");
?>
<?if (!$USER->IsAuthorized()) {?>
<?/*<!-- Marquiz script start -->
	<script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
	  Marquiz.init({
		id: '5dfa484992421d00442ea77e',
		autoOpen: false,
		autoOpenFreq: 'once',
		openOnExit: true
	  });
	});
	</script>
	<!-- Marquiz script end -->
	
	<div class="marquiz-pops marquiz-pops_position_bottom marquiz-pops_blicked marquiz-pops_shadowed" ><a class="marquiz-pops__body" href="#popup:marquiz_5dfa484992421d00442ea77e" data-marquiz-pop-text-color="#ffffff" data-marquiz-pop-background-color="#1d3356" data-marquiz-pop-svg-color="#fff" data-marquiz-pop-close-color="#fff" data-marquiz-pop-color-pulse="rgba(29, 51, 86, 0.4)" data-marquiz-pop-color-pulse-alpha="rgba(29, 51, 86, 0)" data-marquiz-pop-delay="20s" data-marquiz-pop="true"><span class="marquiz-pops__icon"></span><span class="marquiz-pops__content"><span class="marquiz-pops__content-title">Пройти тест</span><span class="marquiz-pops__content-text">&laquo;Подберём автомобиль для Вас!&raquo;</span></span></a></div>
*/?>
<?}?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"offers", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "pages",
		"IBLOCK_ID" => "42",
		"NEWS_COUNT" => "99",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SP_TI",
			1 => "SP_BK",
			2 => "SP_KA",
			3 => "SP_KR",
			4 => "SP_MO",
			5 => "SP_PR",
			6 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_FOLDER" => "/offers/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "offers",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "SP_KA",
			1 => "SP_MO",
			2 => "",
		),
		"AJAX_OPTION_ADDITIONAL" => "",
		"FILE_404" => "/404-in.php",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>