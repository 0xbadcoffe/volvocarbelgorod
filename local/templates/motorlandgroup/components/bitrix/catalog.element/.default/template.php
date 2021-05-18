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
 * @var string $templateFolder
 */

$this->setFrameMode(true);

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
}
?>
<?//Общий шаблон вывода контента?>
	<div class="news-detail">
		<?GetContByIds($arResult['PROPERTY_179'], $this, $APPLICATION)?>
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

