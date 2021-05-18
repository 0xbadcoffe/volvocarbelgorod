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
?>
<?/*
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" align="center"><?=GetMessage("IBLOCK_FILTER_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top"><?=$arItem["NAME"]?>:</td>
					<td valign="top"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>
		</tr>
	</tfoot>
	</table>
</form>

<?
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 print_r($arFields['NAME']);
}
?> 


<?
$min = 1;
$max = 5000000000;

$GLOBALS["arrFilter"]['PROPERTY'][">=AN_PRC"] = $min;
$GLOBALS["arrFilter"]['PROPERTY']["<=AN_PRC"] = $max;
?>

<?$GLOBALS["dfFilter"] = $arResult;?>
*/?>

<?$GLOBALS["dfFilter"] = $arResult;?>