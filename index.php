<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("title", "Официальный дилер Вольво в Белгороде - автосалон Volvo Car");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> <?if (!$USER->IsAuthorized()) {?> 	<?/*<!-- Marquiz script start -->
	<script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
	<script>
	if( window.innerWidth > 900 ){
		document.addEventListener("DOMContentLoaded", function() {
		  Marquiz.init({
			id: '5dfa484992421d00442ea77e',
			autoOpen: false,
			autoOpenFreq: 'once',
			openOnExit: true
		  });
		});
	}
	</script>
	<!-- Marquiz script end -->*/?> 	 
<style>
		@media screen and (max-width: 901px) {
			.marquiz-pops, .smp_menu {
				display: none!important;
			}
		}
	</style>
 <?/*<div class="marquiz-pops marquiz-pops_position_bottom marquiz-pops_blicked marquiz-pops_shadowed"><a id="bxid_196694" class="marquiz-pops__body" href="#popup:marquiz_5dfa484992421d00442ea77e" ><span class="marquiz-pops__icon"></span><span class="marquiz-pops__content"><span class="marquiz-pops__content-title">Пройти тест</span><span class="marquiz-pops__content-text">&laquo;Подберём автомобиль для Вас!&raquo;</span></span></a></div>
*/?> <?}?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/info/page_template/prime_pg_temp.php",
		"EDIT_TEMPLATE" => ""
	)
);?> 
<div class="container"> 	 
  <h2 class="title" style="width: 100%; text-align: center;">Автомобили в наличии</h2>
 		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"avaonprime",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "auto",
		"IBLOCK_ID" => "38",
		"NEWS_COUNT" => "99",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"AN_YER",1=>"AN_DVG",2=>"AN_IMG",3=>"AN_KUZ",4=>"AN_KOM",5=>"AN_LIT",6=>"AN_PRI",7=>"AN_PRO",8=>"AN_KMS",9=>"AN_DTP",10=>"AN_TRA",11=>"AN_COL",12=>"AN_PRC",13=>"AN_FXPR",14=>"AN_MOD",15=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/availability/#ID#/",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
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
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "avaonprime",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_NOTES" => ""
	)
);?> 
</div>
<h2 style="text-align: center;">Зимние оригинальные колеса в сборе при покупке автомобиля Volvo</h2><br>
<div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
<div style="width: 500px; text-align: center;">
<img src="upload/iblock/938/9386da5c66ca4f313f035ce178b2e021.jpg" style="width: 500px;">
<p>При покупке автомобиля Volvo – зимние оригинальные колеса в сборе с выгодой 10%.</p>
<a href="https://volvocarbelgorod.ru/offers/zimnie-originalnye-kolesa-v-sbore-pri-pokupke-avtomobilya-volvo/" tabindex="0" class="btn-blue"> <span>Подробнее</span></a>
	</div>
</div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WPR5JM3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<br>
<h2 style="text-align: center;">Выгода по Трейд-ин</h2>
<div style="display: flex; justify-content: space-around; flex-wrap: wrap;">

	<div style="width: 350px; text-align: center;">
			<img src="/upload/iblock/fb0/404040.jpg" style="width: 300px;" alt="XC40">
		<p style="font-size: 25px;"><strong>Volvo XC40</strong></p>
<p>Выгода до 150 000 руб. по программе трейд-ин</p>
<a href="https://volvocarbelgorod.ru/offers/volvo-xc40-c-sistemoy-lane-keeping-aid/" tabindex="0" class="btn-blue"> <span>Подробнее</span></a>
    </div>

	<div style="width: 350px; text-align: center;">
			<img src="/upload/iblock/fb0/909090.jpg" style="width: 300px;" alt="XC60">
		<p style="font-size: 25px;"><strong>Volvo XC60</strong></p>
<p>Выгода до 250 000 руб. по программе трейд-ин</p>
<a href="https://volvocarbelgorod.ru/offers/volvo-xc60-c-sistemoy-cleanzone/" tabindex="0" class="btn-blue"> <span>Подробнее</span></a>
    </div>

	<div style="width: 350px; text-align: center;">
			<img src="/upload/iblock/fb0/606060.jpg" style="width: 300px;" alt="XC90">
		<p style="font-size: 25px;"><strong>Volvo XC90</strong></p>
<p>Выгода до 200 000 руб. по программе трейд-ин</p>
<a href="https://volvocarbelgorod.ru/offers/volvo-xc90-c-sistemoy-cleanzone/" tabindex="0" class="btn-blue"> <span>Подробнее</span></a>
    </div>
</div>
<br><?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>