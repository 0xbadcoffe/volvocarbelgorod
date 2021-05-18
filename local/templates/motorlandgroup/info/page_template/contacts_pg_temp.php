<?
	$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/contacts.css");
	$arTm[] = $APPLICATION->GetPageProperty('TopPager');

	if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
		require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
	}
?>

<?//Общий шаблон вывода контента?>
<div class="news-detail">
	<?GetContByIds($arTm, $this, $APPLICATION)?> 
</div>