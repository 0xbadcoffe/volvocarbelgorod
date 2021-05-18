<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (!empty($arResult)) {
	$mcont = 0;
	$flag = 0;
	foreach ($arResult as $arfind) {
		if ($arfind['DEPTH_LEVEL'] == 1) {
			$params = explode("%", $arfind['TEXT']);
			if ($params[1] == 'START') {$flag++;} 
			if ($flag == 0) {$mcont++;}
			if ($params[1] == 'END') {$flag--;}
		}
	}
	if ($flag != 0) {?>
		<p style="color:white;">Неправильная START/END сумма (<?=$flag?>)</p>
	<?} else {
		$left = floor($mcont / 2);
	}
}
if ($left && $left > 0) {?>
	<div class="top-menu"><ul class="container prime-menu">
		<?
		$flag = 0;
		$mcont = 0;
		foreach ($arResult as $arItem) {
			if (stripos($APPLICATION->GetCurPage(), $arItem["LINK"]) !== false) {
				$actpg = 'current';
			} else {
				$actpg = '';
			}
			if ($arItem['DEPTH_LEVEL'] == 1) {
				$params = explode("%", $arItem['TEXT']);
				$drop = "";
				$pos1 = stripos($arItem["LINK"], 'http');
				if ($pos1 === false) {} else {$drop = 'target="_blank"';}
				if ($params[1] == 'START') {$flag++;}
				if ($params[0] == "#") {
					if ($params[1] == 'START' || $params[1] == 'END') {
						if ($params[1] == 'START') {
							if ($params[2] == 'SIDES') {?><div class="block-sub-box"><?}
							if ($params[2] == 'LEFT') {?><div class="mo-lef"><?}
							if ($params[2] == 'RIGHT') {?><div class="mo-rig"><?}
							if ($params[2] == 'SUB') {?><ul class="sub-menu"><?}
						} else {
							if ($params[2] == 'LEFT' || $params[2] == 'RIGHT') {?></div><?}
							if ($flag == 1) {
								if ($params[2] == 'SIDES') {?></div></li><?}
								if ($params[2] == 'SUB') {?></ul></li><?}
							} else {
								if ($params[2] == 'SIDES') {?></div><?}
								if ($params[2] == 'SUB') {?></ul><?}
							}
						}
					} else {
						if ($params[1] == "SUB") {?>
							<li class="sub <?=$actpg?>"><a <?=$drop?> href="<?=$arItem["LINK"]?>"><?=$params[2]?></a>
						<?} elseif ($params[1] == "OCLICK") {?>
							<li><a href="javascript:void(0)" onclick="<?=str_replace("/", "", $arItem["LINK"])?>"><?=$params[2]?></a></li>
						<?} elseif ($params[1] == "INFO") {

							// *обработка модельного ряда


							
							if (CModule::IncludeModule('iblock')) { 
								$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_BODY_TYPE", "PROPERTY_LIST_IMG", "PROPERTY_SUFFIX_NAME");
								$arFilter = Array("IBLOCK_ID"=>$params[2], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
								$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
								while($ob = $res->GetNextElement())
								{
									$arFields = $ob->GetFields();
									if ($arFields["PROPERTY_BODY_TYPE_VALUE"] != '') {
										$k_body = $arFields["PROPERTY_BODY_TYPE_VALUE"];
										$k_id = $arFields['ID'];
							
										$k_models[$k_body]['NAME'] = $k_body;
										$k_models[$k_body]['MODELS'][$k_id]['BODY'] = $k_body;
										$k_models[$k_body]['MODELS'][$k_id]['NAME'] = $arFields["NAME"];
										$k_models[$k_body]['MODELS'][$k_id]['IMAG'] = CFile::GetPath($arFields["PROPERTY_LIST_IMG_VALUE"]);
										$k_models[$k_body]['MODELS'][$k_id]['PREV'] = $arFields["PROPERTY_SUFFIX_NAME_VALUE"];
										$k_models[$k_body]['MODELS'][$k_id]['HREF'] = $arFields['DETAIL_PAGE_URL'];
									}
								}
							}
							
							foreach($k_models as $k_model) {?>
								<div class="ryad"><div><?=$k_model['NAME']?></div>
									<?foreach($k_model['MODELS'] as $k_mode) {?>
										<div><a href="/models<?=$k_mode['HREF']?>/">
										<span><?=$k_mode['NAME']?> <span><?=$k_mode['PREV']?></span></span>
										<div class="img-box"><img src="<?=$k_mode['IMAG']?>" /></div></a></div>
									<?}?>
								</div>
							<?}

							// *обработка модельного ряда

						} elseif ($params[1] == "ZAG") {?>
							<div class="zag"><?=$params[2]?></div>
						<?}
					}
				} else {?>
					<li class="<?=$actpg?>"><a <?=$drop?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
				<?}
				if ($flag == 0) {$mcont++;}
				if ($params[1] == 'END') {$flag--;}
			}
		}?>
	</ul></div>
<?}?>