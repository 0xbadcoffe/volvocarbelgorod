<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	$source = intval($_POST['mailto']);
	$model = false;
	$pay = false;
	$tradIn = false;
	$time = false;
	$datetime = date('d.m.Y в H:i');

	$name = trim($_POST["name"]);
	$phone = trim($_POST["phone"]);

	$model = trim($_POST["model"]);
	$pname = trim($_POST["pname"]);
	$soname = trim($_POST["soname"]);
	$pdate = trim($_POST["pdate"]);
	$mail = trim($_POST["mail"]);
	$theme = trim($_POST["theme"]);
	$mail = trim($_POST["mail"]);
	$mail_title = trim($_POST["ttl"]);
	$masege = trim($_POST["masege"]);
	
	switch($source){
		case 0: // форма на странице контакты
		$recepient = "motoslam@mail.ru, o.kirichenko@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
		//case 1: // формы на странице персональный сервис
		//$recepient = "motoslam@mail.ru";
		//break;
		case 2: // Запись на тест-драйв
		$recepient = "motoslam@mail.ru, info1@motorlandgroup.ru, o.kirichenko@motorlandgroup.ru";
		break;
		case 3: // Запрос предложения
		$recepient = "motoslam@mail.ru, o.kirichenko@motorlandgroup.ru, s.veselov@motorlandgroup.ru, a.zacepa@motorlandgroup.ru, a.gupalov@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
		case 4: // Калькулятор ТО
		$recepient = "motoslam@mail.ru, d.varich@motorlandgroup.ru, i.litvinov@motorlandgroup.ru, j.ryazantseva@motorlandgroup.ru, a.zhuravlev@motorlandgroup.ru, e.sovetova@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
		case 5: // Запись на сервис
		$recepient = "motoslam@mail.ru, d.varich@motorlandgroup.ru, i.litvinov@motorlandgroup.ru, j.ryazantseva@motorlandgroup.ru, a.zhuravlev@motorlandgroup.ru, e.sovetova@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
		case 6: // Заказать звонок
		$recepient = "motoslam@mail.ru, info1@motorlandgroup.ru, o.kirichenko@motorlandgroup.ru";
		break;
		case 7: // Купить
		$recepient = "motoslam@mail.ru, o.kirichenko@motorlandgroup.ru, s.veselov@motorlandgroup.ru, a.zacepa@motorlandgroup.ru, a.gupalov@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
		case 8: // Кредит
		$recepient = "motoslam@mail.ru, a.zinova@motorlandgroup.ru, a.kataeva@motorlandgroup.ru, o.kirichenko@motorlandgroup.ru, s.veselov@motorlandgroup.ru, a.zacepa@motorlandgroup.ru, a.gupalov@motorlandgroup.ru, info1@motorlandgroup.ru";
		break;
	}

	ob_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/local/templates/motorlandgroup/mail_template.php');
	$mail = ob_get_contents();
	ob_end_clean();

	$mailheaders = "Content-type:text/html;charset=utf-8\r\n";
    $mailheaders .= "From: Volvo Car Белгород <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
    $mailheaders .= "Reply-To: noreply@" . $_SERVER['SERVER_NAME'] . "\r\n";
	$recepient = explode(',', $recepient);
	foreach ($recepient as $item) {
		mail(trim($item), $mail_title, $mail, $mailheaders);
	}

	echo json_encode(array('status' => 'success'));

}else{
	echo 'mail.php';
}