<?php
header("HTTP/1.0 404 Not Found");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>

<div class="avto_list">
	<div class="avto_list-inner">
		<span class="not-found">404</span>
		<span class="not-found-txt">Страница не найдена</span>
		<span class="not-found-href">вернуться на <a href="/">главную</a></span>
	</div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>