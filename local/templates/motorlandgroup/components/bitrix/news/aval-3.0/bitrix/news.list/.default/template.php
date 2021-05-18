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
//Перебор модельного ряда
$arList = [];

global $dfFilter;

/*
?><pre><?print_r($GLOBALS['arrFilter'])?></pre><?
?><pre><?//print_r($GLOBALS["dfFilter"])?></pre><?
*/
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/mod-detail-list.css");
?>
<?
	$fiSort = $APPLICATION->GetPageProperty('Filter');
	$fiSort = explode(",", $fiSort);

	$arTm[] = $APPLICATION->GetPageProperty('TopPager');

	$this->setFrameMode(true);
	if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
		require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
	}
	
	$arSelect = Array("ID", "IBLOCK_ID", "ACTIVE", "NAME", "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arResult["ID"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(/*"nPageSize"=>99*/), $arSelect);

	if ($fiSort[0]) {
		$sOrder = [];
		foreach ($fiSort as $sort) {
			foreach ($GLOBALS["dfFilter"]["ITEMS"] as $key=>$item) {
				if ($item['NAME'] == $sort) {
					$sOrder[$key] = $item;
					break;
				}
			}
		}
		$GLOBALS["dfFilter"]["ITEMS"] = $sOrder;
	}

	while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		foreach ($GLOBALS["dfFilter"]["ITEMS"] as $key=> $filt) {
			if ($filt['NAME'] == 'Кузов' || $filt['NAME'] == 'Тип двигателя' || $filt['NAME'] == 'Трансмиссия' || $filt['NAME'] == 'Цвет' || $filt['NAME'] == 'Привод' || $filt['NAME'] == 'Объем двигателя') {
				$GLOBALS["dfFilter"]["ITEMS"][$key]['VALS'][$arFields[$key]] = 'Y';
			}
			elseif ($filt['NAME'] == 'Год' || $filt['NAME'] == 'Пробег' || $filt['NAME'] == 'Цена') {
				if (!$GLOBALS["dfFilter"]["ITEMS"][$key]['MIN'] || ($GLOBALS["dfFilter"]["ITEMS"][$key]['MIN'] > $arFields[$key] && $arFields[$key] != 0)) {
					$GLOBALS["dfFilter"]["ITEMS"][$key]['MIN'] = $arFields[$key];
				}
				if (!$GLOBALS["dfFilter"]["ITEMS"][$key]['MAX'] || ($GLOBALS["dfFilter"]["ITEMS"][$key]['MAX'] < $arFields[$key] && $arFields[$key] != 0)) {
					$GLOBALS["dfFilter"]["ITEMS"][$key]['MAX'] = $arFields[$key];
				}
			}
		}
	}
	
	$arSelect = Array("ID", "IBLOCK_ID", "EDIT_LINK", "ACTIVE", "NAME", "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>48, "ID"=>1470);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(/*"nPageSize"=>99*/), $arSelect);
	while($ob = $res->GetNextElement()) {
		$atColor = $ob->GetFields();
		$arColors = $atColor['PROPERTY_244'];
	}
	foreach ($arColors as $Color) {
		$elC = explode(" — ", $Color);
		$reColor[$elC[0]] = $elC[1];
	}
	
	$arButtons = CIBlock::GetPanelButtons(
		$atColor['IBLOCK_ID'],
		$atColor['ID'],
		0,
		array("SECTION_BUTTONS"=>false, "SESSID"=>false)
	);
	$atColor["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
	
	?>
<?//Общий шаблон вывода контента?>
<div class="news-detail">
	<?GetContByIds($arTm, $this, $APPLICATION)?> 
</div>

<div class="auto-run">
	<div class="container">
		<div class="auto-run-wrap">
			<?if ($GLOBALS["dfFilter"]["ITEMS"]) {?>
				<div class="auto-run__sidebar">
                    <div class="filter">
						<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/filter.css");?>
						<form name="<?echo $GLOBALS["dfFilter"]["FILTER_NAME"]."_form"?>" action="<?echo $GLOBALS["dfFilter"]["FORM_ACTION"]?>" method="get" class="filter">
						<?foreach ($GLOBALS["dfFilter"]["ITEMS"] as $key=> $filt) {?>
							<?if (($filt['MIN'] && $filt['MAX'] != $filt['MIN']) || ($filt['VALS'] && count($filt['VALS']) > 1)) {?>
							
								<?if ($filt['INPUT_NAMES']) {?>
									<div class="input-out">
										<input name="<?=$filt['INPUT_NAMES'][0]?>" type="number" data-min="<?=$filt['MIN']?>" data-max="<?=$filt['MAX']?>" value="<?=$filt['INPUT_VALUE']['LEFT']?>" placeholder="<?=$filt['NAME']?> от" max="<?=$filt['MAX']?>" min="<?=$filt['MIN']?>">
										<input name="<?=$filt['INPUT_NAMES'][1]?>" type="number" data-min="<?=$filt['MIN']?>" data-max="<?=$filt['MAX']?>" value="<?=$filt['INPUT_VALUE']['RIGHT']?>" placeholder="до" max="<?=$filt['MAX']?>" min="<?=$filt['MIN']?>">
									</div>
								<?}?>
							
								<?if ($filt['INPUT_NAME']) {?>
									<?if ($filt['NAME'] == "Цвет") {?>
										<p>Цвет:</p>
										<div class="input-chec">
											<?$kolnum = 0;?>
											<?foreach ($filt['VALS'] as $key=>$val) {?>
												<?if ($reColor[$key]) {?>
													<input id="col-<?=$kolnum?>" type="radio" name="<?=$filt['INPUT_NAME']?>" value="<?=$key?>" <?if ($key == $filt['INPUT_VALUE']){?>checked<?}?>>
													<label for="col-<?=$kolnum?>" style="background:<?=$reColor[$key]?>"></label>
													<?$kolnum++;?>
												<?} else {?>
													<pre><?$dumpcol[] = $key?></pre>
												<?}?>
											<?}?>
										</div>
										
										<?global $USER;
										if ($USER->IsAuthorized() && $dumpcol[0]) {?>
											<?
											$this->AddEditAction($atColor['ID'], $atColor['EDIT_LINK'], CIBlock::GetArrayByID($atColor["IBLOCK_ID"], "ELEMENT_EDIT"));
											?>
											<div class="dump" id="<?=$this->GetEditAreaId($atColor['ID']);?>">
												<p>Некоторые цвета отсутствуют в списке</p>
												<ul>
													<?foreach ($dumpcol as $dump) {?>
														<li><?=$dump?></li>
													<?}?>
												</ul>
											</div>
										<?}?>
										
									<?} else {?>
										<div class="input-select">
											<select name="<?=$filt['INPUT_NAME']?>">
												<option value=""><?=$filt['NAME']?></option>
												<?foreach ($filt['VALS'] as $key=>$val) {?>
													<?if ($key != "") {?>
														<option value="<?=$key?>" <?if ($key == $filt['INPUT_VALUE']){?>selected<?}?>><?=$key?></option>
													<?}?>
												<?}?>
											</select>
										</div>
									<?}?>
								<?}?>
								
							<?}?>
						<?}?>
						<input type="submit" name="set_filter" value="искать" />
						<?if ($_GET["set_filter"]) {?>
							<input style="margin-top:10px;" type="submit" name="del_filter" value="сбросить" />
						<?}?>
						</form>
                    </div>
                </div>
			<?}?>

			<div class="auto-run__auto-list">
			<div class="auto-run__box">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?if ($arItem['PROPERTIES']['AN_PRC']['VALUE'] == 0) {continue;}?>
					<div class="auto-run-card__item">
						<?$caritp = explode(" ", $arItem['NAME'])?>
						<div class="auto-run-card__item--name-block car-flx">
							<div class="Name-big">
								<?=$caritp[1]?> 
								<?/*<?if ($arItem['PROPERTIES']['AN_FXPR']['VALUE']) {
									$skid = $arItem['PROPERTIES']['AN_PRC']['VALUE'] - $arItem['PROPERTIES']['AN_FXPR']['VALUE'];
									$skid = 'Выгода до ' . number_format($skid, 0, ',', ' ') . ' ₽';
									$dpcl = ' blueprice';
									} else {*/
									$skid = '';
									$dpcl = '';
									if (strlen($caritp[2]) > 1) {?><span><?=$caritp[2]?><br><?=$caritp[3]?></span><?}
								/*}*/?>
							</div>
							<div class="name-small<?=$dpcl?>"><?=$skid?></div>
						</div>
						<div class="auto-run-card__item--img">
							<?if ($arItem['PROPERTIES']['AN_RUK']['VALUE']) {?>
									<img src="<?=CFile::GetPath($arItem['PROPERTIES']['AN_RUK']['VALUE'][0]);?>" alt="">
							<?} else {?>
									<img src="<?=$arItem['PROPERTIES']['AN_IMG']['VALUE'][0]?>" alt="">
							<?}?>
						</div>
						<div class="auto-run-card__item--content content-cars">
							<div class="auto-run-card__item--char">
								<span><?=$caritp[1]?>,&nbsp;</span>
								<?if ($arItem['PROPERTIES']['AN_PRO']['VALUE']) {?>
									<span><?=$arItem['PROPERTIES']['AN_PRO']['VALUE']?> км,&nbsp;</span>
								<?}?>
								<?if ($arItem['PROPERTIES']['AN_DTP']['VALUE']) {?>
									<span><?=$arItem['PROPERTIES']['AN_DTP']['VALUE']?>,&nbsp;</span>
								<?}?>
								<?if ($arItem['PROPERTIES']['AN_TRA']['VALUE']) {?>
									<span><?=$arItem['PROPERTIES']['AN_TRA']['VALUE']?>,&nbsp;</span>
								<?}?>
								<?if ($arItem['PROPERTIES']['AN_COL']['VALUE']) {?>
									<span><?=$arItem['PROPERTIES']['AN_COL']['VALUE']?>,&nbsp;</span>
								<?}?>
								<?if ($arItem['PROPERTIES']['AN_YER']['VALUE']) {?>
									<span><?=$arItem['PROPERTIES']['AN_YER']['VALUE']?> г.</span>
								<?}?>
								<?if ($arItem['PROPERTIES']['AN_DISL']['VALUE'] != '') {?>
									<br>&nbsp;<br><span class="disl"><?=$arItem['PROPERTIES']['AN_DISL']['VALUE']?></span>
								<?}?>
							</div>


							<div class="auto-run-card__item--price" style="font-weight: 500;">
								<?if ($arItem['PROPERTIES']['AN_FXPR']['VALUE']) {?>
									от <?=number_format($arItem['PROPERTIES']['AN_FXPR']['VALUE'], 0, ',', ' ')?>&nbsp;₽
								<?} else {?>
									<?=number_format($arItem['PROPERTIES']['AN_PRC']['VALUE'], 0, ',', ' ')?>&nbsp;₽
								<?}?>
							</div>
							<div class="auto-card__item--links">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее</a>
								<a href="javascript:void(0)" onclick="window.CallForm(1218);">Получить предложение</a>
							</div>
						</div>
					</div>
				<?endforeach;?>

			</div>
			</div>
		</div>
	</div>
</div>