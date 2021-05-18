<?
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
}
?>
<?if (CModule::IncludeModule("iblock")) {
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>34, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_170"=>38);
	$res = CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, Array("nPageSize"=>99), $arSelect);
	while($ob = $res->GetNextElement()) {
		$arFields[] = $ob->GetFields();
	}

	foreach ($arFields as $Field) {
		$Fieldz[] = $Field['ID'];
	}
}?>
<?//Общий шаблон вывода контента (Тут только для баннеров)?>
<div class="news-detail">
	<?GetContByIds($Fieldz, $this, $APPLICATION)?> 
</div>

<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/prime.css");?>
<div class="models">
	<div class="container">
		<div class="title">Модельный ряд</div>
		<div class="models-box">

			<?$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_138");
				$arFilter = Array("IBLOCK_ID"=>29, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
				while($ob = $res->GetNextElement()) {
					$arField = $ob->GetFields();
			?>
				<a href="<?=$arField['DETAIL_PAGE_URL']?>/" class="models__item">
					<div class="models__item-name"><?=$arField['NAME']?></div>
					<div class="models__item-sub-name"><?=$arField['PROPERTY_138_VALUE']?></div>
				</a>
			<?}?>
		</div>
	</div>
</div>

<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/news-list.css");?>

<?
$arNews = [];
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_TEXT", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>35, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>139);
$res = CIBlockElement::GetList(Array("date_active_from"=>"desc"), $arFilter, false, Array("nPageSize"=>99), $arSelect);
while($ob = $res->GetNextElement()) {
	$arField = $ob->GetFields();
	$arNews[] = $arField;
}?>

    <div class="news">
        <div class="container">
            <div class="slider-news">
                <div class="slider-news__item slider-news__item-text">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/info/news-tx-ttl.php",
							"EDIT_TEMPLATE" => ""
						),
					false
					);?>
                </div>

				<div class="slider-news__item slider-news-col-first">
					<?
					$gkey = 0;
					$flag = 0;
					$lot = count($arNews) - (count($arNews) % 2);
					foreach ($arNews as $key=>$News) {
						if ($key >= 8) {break;}
						$gkey++;
						
						if ((($gkey % 2) == 0 && $flag == 0) || (($gkey % 2) != 0 && $flag != 0)) {
							$dclas = 'slider-news-small-item-b';
						} else {
							$dclas = '';
						}?>
						
						<a href="<?=$News['DETAIL_PAGE_URL']?>" class="slider-news-small-item <?=$dclas?>" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=CFile::GetPath($News['PREVIEW_PICTURE']);?>);">
						
							<?$dat = explode(" ", $News['ACTIVE_FROM']);?>
						
							<div class="slider-news-date"><?=$dat[0]?></div>
							<div class="slider-news-title"><?=$News['NAME']?></div>
							
							<?if ($dclas != '') {?>
								<div class="slider-news-desc">
								<?=substr(strip_tags($News['DETAIL_TEXT']), 0, 150);?>...</div>
							<?}?>
						</a>
						
						
						<?if (($gkey % 2) == 0) {
							if ($flag == 0) {?>
								</div>
								<div class="slider-news__item slider-news-col-second">
								<?$flag = 1;?>
							<?} else {?>
								</div>
								<div class="slider-news__item slider-news-col-first">
								<?$flag = 0;?>
							<?}
						}?>
						
					<?}?>
                </div>
            </div>
			
            <!-- Слайдер новостей для мобильной версии (НАЧАЛО) -->
			
            <div class="slider-news__item-text--mobile">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/info/news-tx-ttl.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
            </div>

			<div class="news-mobile">
				<div class="news-mobile__item">
					<?
					$gkey = 0;
					$lot = count($arNews) - (count($arNews) % 3);
					foreach ($arNews as $key=>$News) {
					if ($key >= $lot) {break;}
					$gkey++;
					?>
					
						<?$dat = explode(" ", $News['ACTIVE_FROM']);?>
						<a href="<?=$News['DETAIL_PAGE_URL']?>" class="slider-news-item" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=CFile::GetPath($News['PREVIEW_PICTURE']);?>);">
							<div class="slider-news-date"><?=$dat[0]?></div>
							<div class="slider-news-title"><?=$News['NAME']?></div>
						</a>
						<?if (($gkey % 3) == 0 && ($key + 1) < $lot) {?>
							</div>
							<div class="news-mobile__item">
						<?}?>
					<?}?>
				</div>
			</div>
            <!-- Слайдер новостей для мобильной версии (КОНЕЦ) -->

        </div>
    </div>