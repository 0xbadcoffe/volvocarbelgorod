<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты | Автосалон Volvo Car - официальный дилер Вольво в Белгороде");
$APPLICATION->SetPageProperty("MapZoom", "15");
$APPLICATION->SetPageProperty("MapText", "volvocarbelgorod");
$APPLICATION->SetPageProperty("MapY", "36.611199");
$APPLICATION->SetPageProperty("MapX", "50.611462");
$APPLICATION->SetPageProperty("TopPager", "1216");
$APPLICATION->SetTitle("Title");
?>	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH . "/info/page_template/contacts_pg_temp.php",
			"EDIT_TEMPLATE" => ""
		),
	false
	);?> 
	
	<div class="contacts-wrap">
        <div class="container">
            <div class="contacts-box">
                <div class="contacts-info-left">
                    <div class="title">Контактная информация</div>
                    <div class="contacts-info__item">
                        <b>Адрес</b>
                        <p>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/info/index.php",
									"EDIT_TEMPLATE" => ""
								),
							false
							);?>, г. 
							
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/info/addr.php",
									"EDIT_TEMPLATE" => ""
								),
							false
							);?>
						</p>
						
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_TEMPLATE_PATH . "/info/marsh.php",
								"EDIT_TEMPLATE" => ""
							),
						false
						);?>
                        
                    </div>
                    <div class="contacts-info__item">
                        <b>Телефон:</b>
                        <p>
							<span>Салон:</span>
							
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/info/phone.php",
									"EDIT_TEMPLATE" => ""
								),
							false
							);?>
						</p>
                    </div>
                    <div class="contacts-info__item">
                        <b>Режим работы:</b>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_TEMPLATE_PATH . "/info/thime-vk.php",
								"EDIT_TEMPLATE" => ""
							),
						false
						);?>
                    </div>
                </div>
                <div class="contacts-info-right">
                    <div id="map" class="map"></div>
                </div>
            </div>

			<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/forms.css");?>
            <div class="contacts-form-wrap m-bottom">
                <div class="title">Свяжитесь с нами</div>
                <form class="aj-form-send" id="form-contacts">
					<input type="hidden" name="ttl" value="Обращение со страницы контактов">
					<input type="hidden" name="mailto" value="0">
                    <div class="contacts-form__item-double">
                        <label for="">Фамилия</label>
                        <input type="text" name="soname">
                    </div>
                    <div class="contacts-form__item-double">
                        <label for="">Имя</label>
                        <input type="text" name="name">
                    </div>
                    <div class="contacts-form__item non-margin">
                        <label for="">Телефон</label>
                        <input type="tel" name="phone" class="phoneg">
                    </div>
                    <div class="contacts-form__item">
                        <label for="">Тема сообщения</label>
                        <input type="text" name="theme">
                    </div>
                    <div class="contacts-form__item non-margin">
                        <label for="">E-mail</label>
                        <input type="e-mail" name="mail">
                    </div>
                    <div class="contacts-form__item non-margin">
                        <label for="">Ваше сообщение</label>
                        <textarea name="masege" id=""></textarea>
                    </div>
                    <div class="contacts-form__item-last">
                        <p class="chex"><input type="checkbox" name="check" id="check" required class="checkbox"><label for="check"><i></i></label><label class="inline" for="check">Согласие на на обработку персональных данных</label></p>
                        <button type="submit" class="btn-blue"><span>Отправить</span></button>
                    </div>
					<p class="call-block__policy-form"></p>

                </form>
            </div>

        </div>
    </div>

<style>
	label.inline {
		border: none;
		display: inline;
		width: auto;
	}
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>