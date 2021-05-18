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
?>
<div class="slider-auto">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?if ($arItem['PROPERTIES']['AN_PRC']['VALUE'] == 0) {continue;}?>
		<div class="auto-run-card__item">
			<?$caritp = explode(" ", $arItem['NAME'])?>
			<div class="auto-run-card__item--name-block car-flx">
				<div class="Name-big"><?=$caritp[1]?> <?if (strlen($caritp[2]) > 1) {?><span><?=$caritp[2]?><br><?=$caritp[3]?></span><?}?></div>
				<?if ($arItem['PROPERTIES']['AN_FXPR']['VALUE']) {?>
					<div class="name-small">от <?=number_format($arItem['PROPERTIES']['AN_FXPR']['VALUE'], 0, ',', ' ')?>&nbsp;₽</div>
				<?} else {?>
					<div class="name-small">от <?=number_format($arItem['PROPERTIES']['AN_PRC']['VALUE'], 0, ',', ' ')?>&nbsp;₽</div>
				<?}?>
			</div>

			<div class="auto-run-card__item--img">
				<?if ($arItem['PROPERTIES']['AN_RUK']['VALUE']) {?>
						<img src="<?=CFile::GetPath($arItem['PROPERTIES']['AN_RUK']['VALUE'][0]);?>" alt="">
				<?} else {?>
						<img src="<?=$arItem['PROPERTIES']['AN_IMG']['VALUE'][0]?>" alt="">
				<?}?>
			</div>
			<div class="auto-run-card__item--content content-cars">
				<div class="auto-card__item--links">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>">Авто в наличии</a>
						<?
							$arSelect = Array("ID", "DETAIL_PAGE_URL", "IBLOCK_ID", "PROPERTY_139");
							$arFilter = Array("IBLOCK_ID"=>29, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "NAME"=>$caritp[1]);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>99), $arSelect);
							while($ob = $res->GetNextElement()) {
								$arFields1 = $ob->GetFields();
							}
						?>
						<?
							$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
							$arFilter = Array("IBLOCK_ID"=>40, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arFields1['PROPERTY_139_VALUE']);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>99), $arSelect);
							while($ob = $res->GetNextElement()) {
								$arFields2 = $ob->GetFields();
							}
						?>
					<?if ($arFields2['PROPERTY_211']) {?>
						<?if (strripos($arFields2['PROPERTY_211'], 'window') !== false) {?>
							<a href="javascript:void(0)" onclick="<?=$arFields2['PROPERTY_211']?>">Конфигуратор</a>
						<?} else {?>
							<a href="<?=$arFields2['PROPERTY_211']?>">Конфигуратор</a>
						<?}?>
					<?}?>
					<?if ($arFields2['PROPERTY_212']) {?>
						<?if (strripos($arFields2['PROPERTY_212'], 'window') !== false) {?>
							<a href="javascript:void(0)" onclick="<?=$arFields2['PROPERTY_212']?>">Цены</a>
						<?} else {?>
							<a href="<?=$arFields2['PROPERTY_212']?>">Цены</a>
						<?}?>
					<?}?>
					<?if ($arFields2['PROPERTY_213']) {?>
						<?if (strripos($arFields2['PROPERTY_213'], 'window') !== false) {?>
							<a href="javascript:void(0)" onclick="<?=$arFields2['PROPERTY_213']?>">Тест-драйв</a>
						<?} else {?>
							<a href="<?=$arFields2['PROPERTY_213']?>">Тест-драйв</a>
						<?}?>
					<?}?>

					<a href="<?=$arFields1['DETAIL_PAGE_URL']?>/">Карточка модели</a>
				</div>
			</div>
		</div>
	<?endforeach;?>
</div>
