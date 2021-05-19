		<footer>
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"menu-3.0",
				Array(
					"ROOT_MENU_TYPE" => "top",
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array()
				),
			false
			);?>
			<div class="container">
				<div class="name">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/info/qwest-img.php",
							"EDIT_TEMPLATE" => ""
						),
					false
					);?>
				</div>
				<div class="addr">
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
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/info/social.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/info/bot-menu.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
				<div class="gen"><a target="_blank" href="https://promo01.ru/">Разработка сайта <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/gen.png" /></a></div>
			</div>
		</footer>

		<?// формы обратной связи
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/plugins/intltel/css/intlTelInput.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/popup.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/forms.css");
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PROPERTY_*", "PROPERTY_VIEW");
			$arFilter = Array("IBLOCK_ID" => 43, "ACTIVE" => "Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99), $arSelect);
			while($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				?>

                <? if($arFields['PROPERTY_VIEW_VALUE'] == 'small-form'): ?>

                    <div class="popup-wrap" id="af-<?=$arFields["ID"]?>">
                        <div class="popup small-form">
                            <a href="javascript: void(0);" class="close-popup"></a>
                            <div class="title"><img src="<?=SITE_TEMPLATE_PATH?>/assets/img/volvo.png"></div>
                            <div class="desc"><?=$arFields["NAME"]?></div>
                            <form class="aj-form-send" id="form-<?=$arFields["ID"]?>">
                                <input type="hidden" name="ttl" value="<?=$arFields["NAME"]?>">
                                <input type="hidden" name="mailto" value="<?=$arFields['PROPERTY_223']?>">
                                <?=$arFields["PREVIEW_TEXT"]?>
                                <div class="rule">
                                    <input type="checkbox" name="rule" id="rule" required>
                                    Даю согласие на обработку своих персональных данных
                                </div>
                                <p class="call-block__policy-form"></p>
                            </form>
                        </div>
                    </div>

                <? elseif($arFields['PROPERTY_VIEW_VALUE'] == 'square-form'):?>

                    <div class="popup-wrap" id="af-<?=$arFields["ID"]?>">
                        <div class="popup square-form">
                            <a href="javascript: void(0);" class="close-popup">Закрыть</a>
                            <div class="title"><img src="<?=SITE_TEMPLATE_PATH?>/assets/img/volvo-white.png"></div>
                            <div class="form-container">
                                <div class="desc"><?=$arFields["NAME"]?></div>
                                <form class="aj-form-send" id="form-<?=$arFields["ID"]?>">
                                    <input type="hidden" name="ttl" value="<?=$arFields["NAME"]?>">
                                    <input type="hidden" name="mailto" value="<?=$arFields['PROPERTY_223']?>">
                                    <?=$arFields["PREVIEW_TEXT"]?>
                                    <div class="rule">
                                        <input type="checkbox" name="rule" id="rule" required>
                                        Даю согласие на обработку своих персональных данных
                                    </div>
                                    <p class="call-block__policy-form"></p>
                                </form>
                            </div>
                        </div>
                    </div>

                <? endif; ?>

				<?
			}
		?>

	</body>

	<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/bs64.css");?>

	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jquery-3.4.1.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/slick.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jquery.fancybox.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jQuery.Brazzers-Carousel.min.js"></script>


	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jquery.maskedinput.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/assets/plugins/intltel/js/intlTelInput.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/script.js"></script>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


	<?if (!$USER->IsAuthorized()) {?>
		<!-- calltouch -->
		<script type="text/javascript">
		(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)};s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","34xpqrmo");
		</script>
		<!-- calltouch -->
		<!-- StreamWood code -->
		<link href="https://clients.streamwood.ru/StreamWood/sw.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="https://clients.streamwood.ru/StreamWood/sw.js" charset="utf-8"  data-skip-moving="true"></script>
		<script type="text/javascript" data-skip-moving="true">
			swQ(document).ready(function(){
				swQ().SW({
					swKey: '11b16a6e5eb412288305a170e325b810',
					swDomainKey: 'a8dd8ffc6f08accd92c06f10afccfda0'
				});
				swQ('body').SW('load');
			});
		</script>
		<!-- /StreamWood code -->
	<?}?>


	<?if ($APPLICATION->GetPageProperty('MapY') && $APPLICATION->GetPageProperty('MapX')) {
		$MapY = $APPLICATION->GetPageProperty('MapY');
		$MapX = $APPLICATION->GetPageProperty('MapX');
		$MapT = $APPLICATION->GetPageProperty('MapText');
		$MapZ = $APPLICATION->GetPageProperty('MapZoom');
		?>
		<script>
			ymaps.ready(init);

			function init() {
				var myMap = new ymaps.Map("map", {
					center: [<?=$MapX?>, <?=$MapY?>],
					zoom: <?=$MapZ?>,
					controls: []
				});

				myMap.controls.add('zoomControl');

				var myGeoObjects = [];
				myGeoObjects = new ymaps.Placemark([<?=$MapX?>, <?=$MapY?>], {
					balloonContentBody: '<?=$MapT?>',
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?=SITE_TEMPLATE_PATH?>/assets/img/svg/map-gps.svg',
					iconImageSize: [60, 65],
					iconImageOffset: [-25, 10]
				});

				var clusterer = new ymaps.Clusterer({
					clusterDisableClickZoom: false,
					clusterOpenBalloonOnClick: false,
				});

				clusterer.add(myGeoObjects);
				myMap.geoObjects.add(clusterer);
				myMap.behaviors.disable('scrollZoom');

			}
		</script>
	<?}?>

	<script>
		$('a').each(function(){
			if ($(this).attr('href') == '#11') {
				$(this).addClass('emptyhref');
			}
			if ($(this).attr('onclick') == '#11') {
				$(this).addClass('emptyhref');
			}
		})
	</script>
</html>
