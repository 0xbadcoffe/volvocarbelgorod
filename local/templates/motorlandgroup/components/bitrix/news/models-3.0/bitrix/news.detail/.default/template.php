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
<?
	if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php")) {
		require_once($_SERVER["DOCUMENT_ROOT"] . "/local/templates/motorlandgroup/include/function-content.php");
	}


	if(CModule::IncludeModule("iblock")) {
		//Получение массива комплектаций
		$arFilter = Array('IBLOCK_ID'=>30, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$arResult['PROPERTIES']['MOD_KOMPL']['VALUE']);
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true);
		while($ar_result = $db_list->GetNext()) {
			$arrayID[] = $ar_result['ID'];
		}
		$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>30, "SECTION_ID"=>$arrayID, 'ACTIVE'=>'Y');
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
		while($ob = $res->GetNextElement()) {
			$arFields[] = $ob->GetFields();
		}
	}

	//Перебор массива комплектаций
	$arComplect = [];
	foreach ($arFields as $key=>$arCompl) {	
		$res = CIBlockSection::GetByID($arCompl["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext()) {

			if ($arCompl['PROPERTY_147'] < $arComplect[$ar_res['NAME']]['MINPR'] || !$arComplect[$ar_res['NAME']]['MINPR']) {
				$arComplect[$ar_res['NAME']]['MINPR'] = $arCompl['PROPERTY_147'];
			}
			
			$arComplect[$ar_res['NAME']]['NAME'] = $ar_res['NAME'];
			// установка дефолтных значений пустоты поля
			if ($arComplect[$ar_res['NAME']]['RASH'] == '') {$arComplect[$ar_res['NAME']]['RASH'] = 'Empty';}
			if ($arComplect[$ar_res['NAME']]['RAZG'] == '') {$arComplect[$ar_res['NAME']]['RAZG'] = 'Empty';}
			if ($arComplect[$ar_res['NAME']]['PRICE'] == '') {$arComplect[$ar_res['NAME']]['PRICE'] = 'Empty';}
			if ($arComplect[$ar_res['NAME']]['TRANS'] == '') {$arComplect[$ar_res['NAME']]['TRANS'] = 'Empty';}
			if ($arComplect[$ar_res['NAME']]['PRIV'] == '') {$arComplect[$ar_res['NAME']]['PRIV'] = 'Empty';}
			if ($arComplect[$ar_res['NAME']]['PLACE'] == '') {$arComplect[$ar_res['NAME']]['PLACE'] = 'Empty';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['ID'] = $arCompl['ID'];
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['NAME'] = $arCompl['NAME'];
			
			// заполнение полей и установка реального значения пустоты поля
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['RASH'] = $arCompl['PROPERTY_143'];
			if ($arCompl['PROPERTY_143'] != '' && $arComplect[$ar_res['NAME']]['RASH'] == 'Empty') {$arComplect[$ar_res['NAME']]['RASH'] = 'nemp';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['RAZG'] = $arCompl['PROPERTY_145'];
			if ($arCompl['PROPERTY_145'] != '' && $arComplect[$ar_res['NAME']]['RAZG'] == 'Empty') {$arComplect[$ar_res['NAME']]['RAZG'] = 'nemp';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['PRICE'] = $arCompl['PROPERTY_147'];
			if ($arCompl['PROPERTY_147'] != '' && $arComplect[$ar_res['NAME']]['PRICE'] == 'Empty') {$arComplect[$ar_res['NAME']]['PRICE'] = 'nemp';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['TRANS'] = GetListValueById($arCompl['PROPERTY_151']);
			if ($arCompl['PROPERTY_151'] != '' && $arComplect[$ar_res['NAME']]['TRANS'] == 'Empty') {$arComplect[$ar_res['NAME']]['TRANS'] = 'nemp';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['PRIV'] = GetListValueById($arCompl['PROPERTY_152']);
			if ($arCompl['PROPERTY_152'] != '' && $arComplect[$ar_res['NAME']]['PRIV'] == 'Empty') {$arComplect[$ar_res['NAME']]['PRIV'] = 'nemp';}
			
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['PLACE'] = $arCompl['PROPERTY_157'];
			if ($arCompl['PROPERTY_157'] != '' && $arComplect[$ar_res['NAME']]['PLACE'] == 'Empty') {$arComplect[$ar_res['NAME']]['PLACE'] = 'nemp';}
			
			// получение кнопок админ панели
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
			$arFilter = Array("IBLOCK_ID"=>31, "ID"=>$arCompl['PROPERTY_156']);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
			while($ob = $res->GetNextElement()) {
				$arFields1 = $ob->GetFields();
			}

			$arButtons = CIBlock::GetPanelButtons(
				30,
				$arCompl['ID'],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['DVIG'] = $arFields1['NAME'];
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['TOPL'] = GetListValueById($arFields1['PROPERTY_153']);

			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['POWER'] = $arFields1['PROPERTY_154'];
			$arComplect[$ar_res['NAME']]['KOMP'][$arCompl['ID']]['KVT'] = $arFields1['PROPERTY_155'];

		}
	}
?>

<?//Визуал?>

<?//Общий шаблон вывода контента?>
<?GetContByIds($arResult['PROPERTY_162'], $this, $APPLICATION)?>

<?//Вывод комплектаций?>
<?$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/equipments.css");?>

	<?/*foreach ($arComplect as $key=>$Complect) {?>
		<div class="model-elem">
			<h1><?=$Complect['NAME']?></h1>
			<?foreach ($Complect['KOMP'] as $Komp) {?>
				<?$this->AddEditAction($Komp['ID'], $Komp['EDIT_LINK'], CIBlock::GetArrayByID(30, "ELEMENT_EDIT"));?>
				<?$this->AddDeleteAction($Komp['ID'], $Komp['DELETE_LINK'], CIBlock::GetArrayByID(30, "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
				<div class="komplect" id="<?=$this->GetEditAreaId($Komp['ID']);?>">
					<b><?=$Komp['DVIG']?> <?if ($Komp['PRIV'] == 'Полный') {?>AWD<?}?></b> || 
					Расход: <i><?=$Komp['RASH']?> л/100км</i> || 
					Мощность: <i><?=$Komp['POWER']?> л.с (<?=$Komp['KVT']?> кВт)</i> || 
					Топливо: <i><?=$Komp['TOPL']?></i> || 
					Разгон до 100: <i><?=$Komp['RAZG']?></i> || 
					Трансмиссия: <i><?=$Komp['TRANS']?></i> || 
					Привод: <i><?=$Komp['PRIV']?></i> || 
					Мест: <i><?=$Komp['PLACE']?></i> || 

					Цена: <i><?=number_format($Komp['PRICE'], 0, ',', ' ')?> ₽</i> 
				</div>
			<?}?>
		</div>
	<?}*/?>

<div class="equipments">
    <div class="title">Комплектации и цены VOLVO <?=$arResult['NAME']?></div>
    <div class="equipments-tabs">
		<?
		$numbe = 0;
		foreach ($arComplect as $key=>$Complect) {?>
			<a href="javascript: void(0);" data-switch="tab_<?=$numbe?>" class="btn-tab <?if ($numbe == 0) {?>active<?}?>">
				<b><?=$Complect['NAME']?></b>
				<span>от <?=number_format($Complect['MINPR'], 0, ',', ' ')?> ₽ </span>
			</a>
		<?
		$numbe++;
		}?>
    </div>
    <div class="modifications">
        <div class="container-modif">
            <div class="title">Модификации</div>

            <?//Таблица комплекатций для десктопной версии (НАЧАЛО) удаляется из DOM на 740px?>
            <div class="modifications-box">
				<?$numbe = 0;
				foreach ($arComplect as $key=>$Complect) {?>
					<div class="modifications-box__item tab_<?=$numbe?>" <?if ($numbe != 0) {?>style="display: none;"<?}?>>
						<div class="modifications-table">
							<div class="modifications-table-tr table-th">
								<div class="modifications-table-td"></div>
								<div class="modifications-table-td">Двигатель</div>
								<?if ($Complect['TRANS'] != 'Empty') {?><div class="modifications-table-td">Трансмиссия</div><?}?>
								<?if ($Complect['RASH'] != 'Empty') {?><div class="modifications-table-td">Расход</div><?}?>
								<?if ($Complect['RAZG'] != 'Empty') {?><div class="modifications-table-td">Разгон<br> до 100 км/ч</div><?}?>
								<?if ($Complect['PLACE'] != 'Empty') {?><div class="modifications-table-td">Количество мест<br></div><?}?>
								<?if ($Complect['PRICE'] != 'Empty') {?><div class="modifications-table-td">Цена</div><?}?>
							</div>
							
							<?foreach ($Complect['KOMP'] as $Komp) {?>
								<?$this->AddEditAction($Komp['ID'], $Komp['EDIT_LINK'], CIBlock::GetArrayByID(30, "ELEMENT_EDIT"));?>
								<?$this->AddDeleteAction($Komp['ID'], $Komp['DELETE_LINK'], CIBlock::GetArrayByID(30, "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
						
								<div class="modifications-table-tr" id="<?=$this->GetEditAreaId($Komp['ID']);?>">
									<div class="modifications-table-td"><b><?=$Komp['DVIG']?> <?if ($Komp['PRIV'] != '') {?><?=$Komp['PRIV']?><?}?></b></div>
									<div class="modifications-table-td"><b><?=$Komp['TOPL']?></b><span><?=$Komp['POWER']?> л.с.</span></div>
									
									<?if ($Complect['TRANS'] != 'Empty') {?>
										<div class="modifications-table-td"><b><?if ($Komp['TRANS'] != '') {?><?=$Komp['TRANS']?><?}?></b></div>
									<?}?>
									<?if ($Complect['RASH'] != 'Empty') {?>
										<div class="modifications-table-td"><?if ($Komp['RASH'] != '') {?><b><?=$Komp['RASH']?></b><span>Литров</span><?}?></div>
									<?}?>
									<?if ($Complect['RAZG'] != 'Empty') {?>
										<div class="modifications-table-td"><?if ($Komp['RAZG'] != '') {?><b><?=$Komp['RAZG']?></b><span>Секунд</span><?}?></div>
									<?}?>
									<?if ($Complect['PLACE'] != 'Empty') {?>
										<div class="modifications-table-td"><?if ($Komp['PLACE'] != '') {?><b><?=$Komp['PLACE']?></b><?}?></div>
									<?}?>
									<?if ($Complect['PRICE'] != 'Empty') {?>
										<div class="modifications-table-td"><?if ($Komp['PRICE'] != '') {?><b>от <?=number_format($Komp['PRICE'], 0, ',', ' ')?> ₽ </b><?}?></div>
									<?}?>
									
								</div>
							<?}?>
						</div>
					</div>
				<?$numbe++;}?>
            </div>
            <?//Таблица комплекатций для десктопной версии (КОНЕЦ)?>


            <?//Таблица комплекатций для мобильной версии (НАЧАЛО) показывается на 740px?>

            <div class="modifications-box__mobile">
				<?$numbe = 0;
				foreach ($arComplect as $key=>$Complect) {?>
					<div class="modifications-box__item-mobile tab_<?=$numbe?>" <?if ($numbe != 0) {?>style="display: none;"<?}?>>
					
						<div class="table-tabs">
							<?$numbz = 0;
							foreach ($Complect['KOMP'] as $Komp) {?>
								<a href="javascript: void(0);" data-switch="table<?=$numbe?>-mod<?=$numbz?>" class="table-tabs__item <?if ($numbz == 0) {?>active<?}?>">
									<?=$Komp['DVIG']?> <?if ($Komp['PRIV'] != '') {?><?=$Komp['PRIV']?><?}?>
								</a>
							<?$numbz++;}?>
						</div>
						
						<?$numbz = 0;
						foreach ($Complect['KOMP'] as $Komp) {?>
							<div class="modifications-table__mobile" id="table<?=$numbe?>-mod<?=$numbz?>" <?if ($numbz != 0) {?>style="display: none;"<?}?>>
								<div class="modifications-table__mobile-tr">
									<div class="modifications-table__mobile-td">Двигатель</div>
									<div class="modifications-table__mobile-td"><?=$Komp['TOPL']?><br><?=$Komp['POWER']?> л.с.</div>
								</div>
								<?if ($Komp['TRANS'] != '') {?>
									<div class="modifications-table__mobile-tr">
										<div class="modifications-table__mobile-td">Трансмиссия</div>
										<div class="modifications-table__mobile-td"><?=$Komp['TRANS']?></div>
									</div>
								<?}?>
								<?if ($Komp['RASH'] != '') {?>
									<div class="modifications-table__mobile-tr">
										<div class="modifications-table__mobile-td">Расход</div>
										<div class="modifications-table__mobile-td"><?=$Komp['RASH']?><br> Литров</div>
									</div>
								<?}?>	
								<?if ($Komp['RAZG'] != '') {?>
									<div class="modifications-table__mobile-tr">
										<div class="modifications-table__mobile-td">Разгон до 100 км/ч</div>
										<div class="modifications-table__mobile-td"><?=$Komp['RAZG']?><br> Секунд</div>
									</div>
								<?}?>
								<?if ($Komp['PLACE'] != '') {?>
									<div class="modifications-table__mobile-tr">
										<div class="modifications-table__mobile-td">Количество мест</div>
										<div class="modifications-table__mobile-td"><?=$Komp['PLACE']?></div>
									</div>
								<?}?>
								<?if ($Komp['PRICE'] != '') {?>
									<div class="modifications-table__mobile-tr">
										<div class="modifications-table__mobile-td">Цена</div>
										<div class="modifications-table__mobile-td">от <?=number_format($Komp['PRICE'], 0, ',', ' ')?> ₽</div>
									</div>
								<?}?>
							</div>
						<?$numbz++;}?>
					</div>
                <?$numbe++;}?>
            </div>
            <?//Таблица комплекатций для мобильной версии (КОНЕЦ)?>

        </div>
    </div>
</div>