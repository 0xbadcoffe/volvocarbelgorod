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
$APPLICATION->SetPageProperty("body_css", "auto-list-page");
?>
<?
//Перебор модельного ряда
$arList = [];
foreach($arResult["ITEMS"] as $arItem):
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['NAME'] = $arItem['PROPERTIES']['MOD_KUZOV']['VALUE'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['ID'] = $arItem['ID'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['EDIT_LINK'] = $arItem['EDIT_LINK'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['DELETE_LINK'] = $arItem['DELETE_LINK'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]["IBLOCK_ID"] = $arItem["IBLOCK_ID"];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['NAME'] = $arItem['NAME'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['MOD_NAME_SUB'] = $arItem['PROPERTIES']['MOD_NAME_SUB']['VALUE'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['MOD_KUZOV'] = $arItem['PROPERTIES']['MOD_KUZOV']['VALUE'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['MOD_HREFS'] = $arItem['PROPERTIES']['MOD_HREFS']['VALUE'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE']['SRC'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['PREVIEW_TEXT'] = $arItem['PREVIEW_TEXT'];
	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['DETAIL_PAGE_URL'] = $arItem['DETAIL_PAGE_URL'];

	//Получение минимальной цены из комплектаций
	$minprice = 0;
	$arrayID = [];
	if(CModule::IncludeModule("iblock")) {
		$arFilter = Array('IBLOCK_ID'=>30, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$arItem['PROPERTIES']['MOD_KOMPL']['VALUE']);
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true);
		while($ar_result = $db_list->GetNext()) {
			$arrayID[] = $ar_result['ID'];
		}
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_147");
		$arFilter = Array("IBLOCK_ID"=>30, "SECTION_ID"=>$arrayID);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
		while($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			if ($arFields['PROPERTY_147_VALUE'] < $minprice || $minprice == 0) {
				$minprice = $arFields['PROPERTY_147_VALUE'];
			}
		}
	}

	$arList[$arItem['PROPERTIES']['MOD_KUZOV']['VALUE']]['ELEMS'][$arItem['ID']]['MIN_PRICE'] = $minprice;
endforeach;?>

<?//Визуал?>

<?/* не использованные свойства
	<b>Кузов:</b> <?=$k['MOD_KUZOV']?><br>
	<b>Описание:</b> <?=$k['PREVIEW_TEXT']?><br>
*/?>

<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/model-list.css");?>
<div class="auto-list">
	<div class="container">
		<div class="auto-list-box">
			<div class="auto-list-box__left">

				<?foreach($arList as $v):?>
					<?if ($v['NAME'] == "Седан") {
						$name = "cеданы";
					} elseif ($v['NAME'] == "Универсал") {
						$name = "cross country";
					} elseif ($v['NAME'] == "Кроссовер") {
						$name = "кроссоверы и внедорожники";
					} else {
						$name = $v['NAME']."ы";
					}?>
					<div class="title"><?=$name?></div>
					<div class="auto-list__items">
						<?foreach($v['ELEMS'] as $k):?>
							<?$this->AddEditAction($k['ID'], $k['EDIT_LINK'], CIBlock::GetArrayByID($k["IBLOCK_ID"], "ELEMENT_EDIT"));?>
							<?$this->AddDeleteAction($k['ID'], $k['DELETE_LINK'], CIBlock::GetArrayByID($k["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
							<div class="auto-card__item" id="<?=$this->GetEditAreaId($k['ID']);?>">
								<div class="auto-card__item--name">
									<div class="models__item">
										<div class="models__item-name"><?=$k['NAME']?></div>
										<div class="models__item-sub-name"><?=$k['MOD_NAME_SUB']?></div>
									</div>
									<div class="models__item-price">от<br><?=number_format($k['MIN_PRICE'], 0, ',', ' ')?> ₽</div>
								</div>
								<div class="auto-card__item--img img-wrap">
									<a href="<?=$k['DETAIL_PAGE_URL']?>">
										<img src="<?=$k['PREVIEW_PICTURE']?>" />
									</a>
								</div>
								
								<?$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
									$arFilter = Array("IBLOCK_ID"=>40, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$k['MOD_HREFS']);
									$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
									while($ob = $res->GetNextElement()) {
										$arField = $ob->GetFields();
									?>
									<div class="auto-card__item--links">
										<?if ($arField['PROPERTY_210']) {?>
											<?if (strripos($arField['PROPERTY_210'], 'window') !== false) {?>
												<a href="javascript:void(0)" onclick="<?=$arField['PROPERTY_210']?>">Авто в наличии</a>
											<?} else {?>
												<a href="<?=$arField['PROPERTY_210']?>">Авто в наличии</a>
											<?}?>
										<?}?>
										<?if ($arField['PROPERTY_211']) {?>
											<?if (strripos($arField['PROPERTY_211'], 'window') !== false) {?>
												<a href="javascript:void(0)" onclick="<?=$arField['PROPERTY_211']?>">Конфигуратор</a>
											<?} else {?>
												<a href="<?=$arField['PROPERTY_211']?>">Конфигуратор</a>
											<?}?>
										<?}?>
										<?if ($arField['PROPERTY_212']) {?>
											<?if (strripos($arField['PROPERTY_212'], 'window') !== false) {?>
												<a href="javascript:void(0)" onclick="<?=$arField['PROPERTY_212']?>">Цены</a>
											<?} else {?>
												<a href="<?=$arField['PROPERTY_212']?>">Цены</a>
											<?}?>
										<?}?>
										<?if ($arField['PROPERTY_213']) {?>
											<?if (strripos($arField['PROPERTY_213'], 'window') !== false) {?>
												<a href="javascript:void(0)" onclick="<?=$arField['PROPERTY_213']?>">Тест-драйв</a>
											<?} else {?>
												<a href="<?=$arField['PROPERTY_213']?>">Тест-драйв</a>
											<?}?>
										<?}?>
										<a href="<?=$k['DETAIL_PAGE_URL']?>">Карточка модели</a>
									</div>
								<?}?>
								
							</div>
						<?endforeach;?>
					</div>
				<?endforeach;?>

			</div>
			<?/*<div class="auto-list-box__right">
				<div class="title">Узнать больше</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/info/auto-list-lin.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?> 
</div>*/?>
		</div>
	</div>
</div>
