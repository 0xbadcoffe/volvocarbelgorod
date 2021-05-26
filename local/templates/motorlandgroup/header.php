<!DOCTYPE html>
<html>
	<head>
		<?if (!$USER->IsAuthorized()) {?>
			<script data-skip-moving="true" async src="https://www.googletagmanager.com/gtag/js?id=UA-62115054-13"></script>
			<script data-skip-moving="true">
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', 'UA-62115054-13');
			</script>
		<?}?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WPR5JM3');</script>
<!-- End Google Tag Manager -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/32.ico" type="image/vnd.microsoft.icon">
		<link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/48.ico" type="image/vnd.microsoft.icon">
		
		<link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-152x152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/assets/ico/apple-touch-icon-180x180.png" />
		
		<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/fonts.css");?>
		<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/style.css");?>

		<?$APPLICATION->ShowHead();?>

		<?if (!$USER->IsAuthorized()) {?>
			<!-- Yandex.Metrika informer -->
				<a style="display:none;" href="https://metrika.yandex.ru/stat/?id=29719965&amp;from=informer"
				target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/29719965/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
				style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="29719965" data-lang="ru" /></a>
			<!-- /Yandex.Metrika informer -->
	
			<!-- Yandex.Metrika counter -->
			<script type="text/javascript" data-skip-moving="true">
				(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
				m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
				(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			
				ym(29719965, "init", {
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			</script>


			<noscript><div><img src="https://mc.yandex.ru/watch/29719965" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			<!-- /Yandex.Metrika counter -->
			<!-- Yandex.Metrika counter -->
			<script type="text/javascript" data-skip-moving="true">
				(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
				m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
				(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			
				ym(56351857, "init", {
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			</script>
			<noscript><div><img src="https://mc.yandex.ru/watch/56351857" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			<!-- /Yandex.Metrika counter -->
			<!-- Smartpoint Code Start -->
			<script type="text/javascript" data-skip-moving="true">
				(function(w, p) {
					var a, s;
					(w[p] = w[p] || []).push(
						"uid=109043",
						"site="+encodeURIComponent(window.location.href)
					);
					a = document.createElement('script'); a.type = 'text/javascript'; a.async = true;	a.charset='utf-8';
					a.src = 'https://panel.smartpoint.pro/collectwidgets/?'+window.SMP_params.join('&');
					s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(a, s);
				})(window, 'SMP_params');
			</script>
			<!-- Smartpoint Code End -->
			<script data-skip-moving="true" src='https://code.reffection.com/pixel/tags/5a48c4ffc10e6850408b63f704116e56cbbc64d0'></script>
		<?}?>
		
	</head>
	<body class="<?$APPLICATION->ShowProperty("body_css");?>">
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		
		<?
			global $USER;
			if ($USER->IsAuthorized()) {?><div class="slider-autoplay-none"></div><?}
		?>
		
		<div class="fixed-block">
			<?
			if(CModule::IncludeModule("iblock")) {
				$arSelect = Array("ID", "IBLOCK_ID", "PREVIEW_PICTURE", "NAME", "PROPERTY_*");
				$arFilter = Array("IBLOCK_ID"=>41, "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
				while($ob = $res->GetNextElement()) {
					$arFields = $ob->GetFields();
					?>
						<?if ($arFields['PROPERTY_215'] == 71) {?>
							<a href="<?=$arFields['PROPERTY_216']?>" class="btn-test-drive">
						<?} else {?>
							<a href="javascript: void(0);" onclick="<?=$arFields['PROPERTY_216']?>" class="btn-test-drive">
						<?}?>
							<i style="background-image:url(<?=CFile::GetPath($arFields['PREVIEW_PICTURE']);?>);"></i>
							<span><?=$arFields['NAME']?></span>
						</a>
					<?
				}
			}
			?>
        </div>

		<header>
			<div class="container top-wrap">
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
				<a class="logo" href="/"><img src="<?=SITE_TEMPLATE_PATH?>/assets/img/logo.png" /></a>
				<div class="info">
					<div class="addres">
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
							"PATH" => SITE_TEMPLATE_PATH . "/info/phone.php",
							"EDIT_TEMPLATE" => ""
						),
					false
					);?>
				</div>
			</div>
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
		</header>