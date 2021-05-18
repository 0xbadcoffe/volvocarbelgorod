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

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
}
?>
<?//Общий шаблон вывода контента?>
	<div class="news-detail">
		<?GetContByIds($arResult['PROPERTY_217'], $this, $APPLICATION)?>
	</div>

<?if ($arResult['DETAIL_TEXT']) {?>
<div class="container margin-top m-bottom">
	<h1><?=$arResult['NAME']?></h1>
	<?=$arResult['DETAIL_TEXT']?>
	<?if ($arResult['DETAIL_PICTURE']) {?>
		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" width="100%" style="max-width:740px" />
	<?}?>
</div>
<?}?>