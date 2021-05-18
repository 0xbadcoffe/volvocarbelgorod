<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
}
?>

<?foreach (getParentSections($arResult['ID']) as $navchan) {
	$res = CIBlockSection::GetByID($navchan);
	if($ar_res = $res->GetNext())
	$APPLICATION->AddChainItem($ar_res['NAME'], $ar_res['SECTION_PAGE_URL']);
}?>

<?//Общий шаблон вывода контента?>
<div class="news-detail">
	<?GetContByIds($arResult['UF_PAGEBLOCK'], $this, $APPLICATION)?> 
</div>

<?
$arRes = [];
$resNum = 0;
$rsParentSection = CIBlockSection::GetByID($arResult['ID']);
if ($arParentSection = $rsParentSection->GetNext()) {
	$arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
	$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
	while ($arSect = $rsSect->GetNext()) {
		$arRes[$resNum]['TYPE'] = 'RAZ';
		$arRes[$resNum]['ID'] = $arSect['ID'];
		$arRes[$resNum]['SORT'] = $arSect['SORT'];
		$arRes[$resNum]['NAME'] = $arSect['NAME'];
		$arRes[$resNum]['PICTURE'] = $arSect['PICTURE'];
		$arRes[$resNum]['DESCRIPTION'] = $arSect['DESCRIPTION'];
		$arRes[$resNum]['URL'] = $arSect['SECTION_PAGE_URL'];
	
		$arButtons = CIBlock::GetPanelButtons(
			$arSect["IBLOCK_ID"],
			0,
			$arSect["ID"],
			array("SESSID"=>false)
		);
		$arRes[$resNum]["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
		$arRes[$resNum]["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];
	
		$resNum++;
	}
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "SORT", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PREVIEW_TEXT", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$arResult['ID']);
$res = CIBlockElement::GetList(Array("date_active_from"=>"desc"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();

	$arRes[$resNum]['TYPE'] = 'PAG';
	$arRes[$resNum]['ID'] = $arFields['ID'];
	$arRes[$resNum]['SORT'] = $arFields['SORT'];
	$arRes[$resNum]['NAME'] = $arFields['NAME'];
	$arRes[$resNum]['PICTURE'] = $arFields['PREVIEW_PICTURE'];
	$arRes[$resNum]['DESCRIPTION'] = $arFields['PREVIEW_TEXT'];
	$arRes[$resNum]['URL'] = $arFields['DETAIL_PAGE_URL'];
	
	$arButtons = CIBlock::GetPanelButtons(
		$arFields["IBLOCK_ID"],
		$arFields['ID'],
		0,
		array("SECTION_BUTTONS"=>false, "SESSID"=>false)
	);
	$arRes[$resNum]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
	$arRes[$resNum]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

	$resNum++;
}

usort($arRes, function($a, $b){
    return ($a['SORT'] - $b['SORT']);
});
?>

<?// Пагенация?>
<?
$nop = 6;
$elCo = ceil(count($arRes) / $nop);
if ($_GET['page']) {
	$pStart = $nop * ($_GET['page'] - 1);
	$pEnd = $nop * $_GET['page'] - 1;
} else {
	$pStart = 0;
	$pEnd = $nop - 1;
}

?>



<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/opus.css");?>

<div class="news-detail">
	<div class="m-bottom container contents car-opus rgs-3 <?if (count($arResult['UF_PAGEBLOCK']) < 1) {?>margin-top<?}?>">
		<?foreach ($arRes as $key=>$arElem) {?>
			<?if ($key < $pStart || $key > $pEnd) {
				continue;
			} else {?>

				<?if($arElem['TYPE'] == 'RAZ') {
					$edit = 'SECTION_EDIT';
					$dele = 'SECTION_DELETE';
					$conf = 'CT_BNL_SECTION_DELETE_CONFIRM';
				} else {
					$edit = 'ELEMENT_EDIT';
					$dele = 'ELEMENT_DELETE';
					$conf = 'CT_BNL_ELEMENT_DELETE_CONFIRM';
				}?>
		
				<?$this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID(35, $edit));?>
				<?$this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID(35, $dele), array("CONFIRM" => GetMessage($conf)));?>
		
				<div class="ryad-block " id="<?=$this->GetEditAreaId($arElem['ID']);?>">
				
					<div class="ryad3 ">
						<div class="image-car slider-top">
							<div class="image-car-item">
								<div class="img-wrap">
									<img src="<?=CFile::GetPath($arElem['PICTURE']);?>">
								</div>
							</div>
						</div>
						<div class="auto-description__text">

							<div class="auto-description-title"><?=$arElem['NAME']?></div>
							<?if ($arElem['DESCRIPTION'] != '') {?>
								<p><?=$arElem['DESCRIPTION']?></p>
							<?}?>
							<a href="<?=$arElem['URL']?>" class="btn-blue"><span>Перейти</span></a>

						</div>
					</div>
					
				</div>

			<?}?>
		<?}?>
		
	<?// Пагенация?>

	<?if ($elCo > 1) {?>
		<?
			if ($_GET['page']) {
				$for = $_GET['page'] + 1;
			} else {
				$for = 2;
			}
			$bac = $_GET['page'] - 1;
		?>
		<div class="container">
			<ul class="page-list">
				<?if ($_GET['page'] != '' && $_GET['page'] != 1) {?>
					<li class="txx"><a href="?page=1">первая</a></li>
					<?if ($bac != 1) {?>
						<li><a href="?page=<?=$bac?>">&lt;&lt;</a></li>
					<?}?>
				<?}?>
				<?for ($i = 0; $i < $elCo; $i++) {?>
					<?$ps = $i + 1;?>
					<?if ($_GET['page'] == $ps || (!$_GET['page'] && $ps == 1)) {?>
						<li class="active"><a href="javascript:void(0)"><?=$ps?></a></li>
					<?} else {?>
						<li><a href="?page=<?=$ps?>"><?=$ps?></a></li>
					<?}?>
				<?}?>
				<?if ($_GET['page'] != $elCo) {?>
					<?if ($for != $elCo) {?>
					<li><a href="?page=<?=$for?>">&gt;&gt;</a></li>
					<?}?>
					<li class="txx"><a href="?page=<?=$elCo?>">последняя</a></li>
				<?}?>
			</ul>
		</div>
	<?}?>
	</div>
</div>
