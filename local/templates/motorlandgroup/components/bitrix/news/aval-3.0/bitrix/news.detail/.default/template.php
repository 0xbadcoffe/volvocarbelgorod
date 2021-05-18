<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/mod-detail-list.css");
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/fancybox.css");
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/slick.css");
?>
<div class="content models">
			<div class="container mod-gs">
				<div class="car-img-clc">
					<div class="car-left">
						<?if ($arResult['PROPERTIES']['AN_RUK']['VALUE']) {
							$imaga = CFile::GetPath($arResult['PROPERTIES']['AN_RUK']['VALUE'][0]);
						} else {
							$imaga = $arResult['PROPERTIES']['AN_IMG']['VALUE'][0];
						}?>
						<div class="img-wrap"><img src="<?=$imaga?>" /></div>
					</div>
					<div class="car-righ">
						<?if ($arResult['PROPERTIES']['AN_RUK']['VALUE']) {?>
							<?foreach($arResult['PROPERTIES']['AN_RUK']['VALUE'] as $key=>$img) {?>

								<a class="img-wrap fancybox <?if ($key == 0) {?>on-act<?}?>" data-fancybox="gallery" rel="group" href="<?=CFile::GetPath($img);?>" style="display:block;">
									<img src="<?=CFile::GetPath($img);?>" />
								</a>

								<?if ($key == 5) {break;}?>
							<?}?>
						<?} else {?>
							<?foreach($arResult['PROPERTIES']['AN_IMG']['VALUE'] as $key=>$img) {?>

								<a class="img-wrap fancybox <?if ($key == 0) {?>on-act<?}?>" data-fancybox="gallery" rel="group" href="<?=$img?>" style="display:block;">
									<img src="<?=$img?>" />
								</a>

								<?if ($key == 5) {break;}?>
							<?}?>
						<?}?>

					</div>
				</div>
			</div>
			<div class="container">
				<h1><?=$arResult['NAME']?></h1>
				<ul class="breadcrumb">
					<li><a href="/">Главная</a></li>
					<li><a href="/availability/">Автомобили в наличии</a></li>
					<li><a href="javascript:void(0)"><?=$arResult['NAME']?></a></li>
				</ul>
				<div class="car-info">
					<div class="car-info-left">
						<div class="grey-info">
							<?if ($arResult['PROPERTIES']['AN_KUZ']['VALUE']) {?>
								<div class="item">
									<div class="zag">Кузов</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_KUZ']['VALUE']?></div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_TRA']['VALUE']) {?>
								<div class="item">
									<div class="zag">Трансмиссия</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_TRA']['VALUE']?></div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_KOM']['VALUE']) {?>
								<div class="item">
									<div class="zag">Комплектация</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_KOM']['VALUE']?></div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_YER']['VALUE']) {?>
								<div class="item">
									<div class="zag">Год выпуска</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_YER']['VALUE']?> г.</div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_DVG']['VALUE']) {?>
								<div class="item">
									<div class="zag">Двигатель</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_DVG']['VALUE']?> л.с.</div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_TOPL']['VALUE']) {?>
								<div class="item">
									<div class="zag">Топливо</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_TOPL']['VALUE']?></div>
								</div>
							<?}?>
							<?if ($arResult['PROPERTIES']['AN_PRO']['VALUE']) {?>
								<div class="item">
									<div class="zag">Пробег</div>
									<div class="tex"><?=$arResult['PROPERTIES']['AN_PRO']['VALUE']?> км</div>
								</div>
							<?}?>


						</div>
					</div>
					<div class="car-info-righ">
						<?$skid = "";?>
						<?if ($arResult['PROPERTIES']['AN_FXPR']['VALUE']) {
							$skid = $arResult['PROPERTIES']['AN_PRC']['VALUE'] - $arResult['PROPERTIES']['AN_FXPR']['VALUE'];
							$skid = 'Выгода до ' . number_format($skid, 0, ',', ' ') . ' ₽';?>
							<div class="car-price gvtgc"><span>от</span> <?=number_format($arResult['PROPERTIES']['AN_FXPR']['VALUE'], 0, ',', ' ')?>&nbsp;₽<sup>*</sup></div>
						<?/*<div class="vig-car-price"><?=$skid?></div>*/?>
						<?} else {?>
							<div class="car-price"><?=number_format($arResult['PROPERTIES']['AN_PRC']['VALUE'], 0, ',', ' ')?>&nbsp;₽</div>
						<?}?>
						<a href="javascript:void(0)" class="bay btn-popup" data-id="pt-<?=$arResult['ID']?>">Купить<i>></i></a><br>
						<a href="javascript:void(0)" class="kre btn-popup" data-id="apt-<?=$arResult['ID']?>">Заявка на кредит<i>></i></a>
					</div>

					<?$thi_pg = $_SERVER['HTTP_HOST'] . "" . $arResult['DETAIL_PAGE_URL'];?>

					<div class="popup-wrap" id="pt-<?=$arResult['ID']?>">
						<div class="popup">
							<a href="javascript: void(0);" class="close-popup"></a>
							<div class="title">Купить <?=$arResult['NAME']?></div>
							<div class="desc"></div>
							<form class="aj-form-send" id="form-<?=$arResult['ID']?>">
								<input type="hidden" name="ttl" value="Запрос на покупку со страницы (<?=$thi_pg?>)">
								<input type="hidden" name="model" value="<?=$arResult['NAME']?>">
								<input type="hidden" name="mailto" value="7">	
								<div class="popup-form-item" style="margin-right:5px;">
									<label for="">Имя</label>
									<input type="text" required name="name">
								</div>
								<div class="popup-form-item">
									<label for="">Телефон</label>
									<input type="tel" required name="phone">
								</div>	
								<button type="submit"><span>Отправить</span></button>	
								<p class="call-block__policy-form"></p>
							</form>
						</div>
					</div>
					
					<div class="popup-wrap" id="apt-<?=$arResult['ID']?>">
						<div class="popup">
							<a href="javascript: void(0);" class="close-popup"></a>
							<div class="title">Купить <?=$arResult['NAME']?></div>
							<div class="desc"></div>
							<form class="aj-form-send" id="form-c-<?=$arResult['ID']?>">
								<input type="hidden" name="ttl" value="Запрос на покупку в кредит со страницы (<?=$thi_pg?>)">
								<input type="hidden" name="model" value="<?=$arResult['NAME']?>">
								<input type="hidden" name="mailto" value="8">	
								<div class="popup-form-item" style="margin-right:5px;">
									<label for="">Имя</label>
									<input type="text" required name="name">
								</div>
								<div class="popup-form-item">
									<label for="">Телефон</label>
									<input type="tel" required name="phone">
								</div>	
								<button type="submit"><span>Отправить</span></button>	
								<p class="call-block__policy-form"></p>
							</form>
						</div>
					</div>

					<?if ($arResult['DETAIL_TEXT']) {?>
						<div class="car-info-mid">
							<?=$arResult['DETAIL_TEXT']?>
						</div>
					<?}?>

				</div>
				<h2>Комплектация <?=$arResult['PROPERTIES']['AN_KOM']['VALUE']?></h2>
				<div class="car-kompl">
					<ul>
						<?
						$half = round(count($arResult['PROPERTIES']['AN_KMS']['VALUE']) / 2);
						foreach ($arResult['PROPERTIES']['AN_KMS']['VALUE'] as $key=>$vale) {?>
							<li><?=$vale?></li>
							<?if ($key == $half) {?></ul><ul><?}?> 
						<?}?>
					</ul>
				</div>
			</div>
		</div>

<?if ($arResult['PREVIEW_TEXT']) {?>
	<div class="container">
		<i>* <?=$arResult['PREVIEW_TEXT']?></i><br>&nbsp;<br>
	</div>
<?}?>



<div class="container">
	<h2 class="title" style="width:100%; text-align:center;">Ваш следующий шаг</h2>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH."/info/next-step.php",
			"EDIT_TEMPLATE" => ""
		)
	);?>
</div>

<div class="container">
	<h2 class="title" style="width:100%; text-align:center;">Автомобили в наличии</h2>
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"avaonprime", 
	array(
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
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "AN_YER",
			1 => "AN_DVG",
			2 => "AN_IMG",
			3 => "AN_KUZ",
			4 => "AN_MOD",
			5 => "AN_KOM",
			6 => "AN_LIT",
			7 => "AN_PRI",
			8 => "AN_PRO",
			9 => "AN_KMS",
			10 => "AN_DTP",
			11 => "AN_TRA",
			12 => "AN_COL",
			13 => "AN_PRC",
			14 => "",
		),
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
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

</div>