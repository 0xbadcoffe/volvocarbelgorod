<?
	//Значение из множественного списка по id
	function GetListValueById($IDS) {
		if ($IDS) {
			$UserField = CIBlockPropertyEnum::GetList(array(), array("ID" => $IDS));
			if($UserFieldAr = $UserField->GetNext()) {return $UserFieldAr["VALUE"];}
			else return false;
		} else {return false;}
	}
	
	function GetBkOnPg($aply) {
		?><div class="container br-crumb"><?
			$aply->IncludeComponent(
				"bitrix:breadcrumb",
				"bk-tm",
				Array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => "-"
				),
			false
			);
		?></div><?
	}
	
	function getParentSections($section_id){
	   $result = array();
	   $nav = CIBlockSection::GetNavChain(false, $section_id);
	   while($v = $nav->GetNext()) {
		   if($v['ID']) {
			   Bitrix\Main\Diag\Debug::writeToFile('ID => ' . $v['ID']);
			   Bitrix\Main\Diag\Debug::writeToFile('NAME => ' . $v['NAME']);
			   Bitrix\Main\Diag\Debug::writeToFile('DEPTH_LEVEL => ' . $v['DEPTH_LEVEL']);
			   $result[] = $v['ID'];
		   }
	   }
	   return $result;
	}

	//Получение массива контента по id
	function GetContByIds($ID, $ndfs, $aply, $bk = true) {
		if(CModule::IncludeModule("iblock")) {
			$kas = 0;
			$temp = 0;
			$temp2 = 0;
			$temp3 = 0;
			$temp4 = 0;
			foreach ($ID as $key=>$arElem) {
				$arSelect = Array("ID", "IBLOCK_ID", "EDIT_LINK", "PREVIEW_PICTURE", "PREVIEW_TEXT", "ACTIVE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "DETAIL_TEXT", "NAME", "PROPERTY_*");
				$arFilter = Array("IBLOCK_ID"=>CIBlockElement::GetIBlockByID($arElem), "ID"=>$arElem);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
				while($ob = $res->GetNextElement()) {
					$arFields[] = $ob->GetFields();
					
					if ($arFields[$key]['ACTIVE'] == 'N') {
						continue;
					}
					
					if ($arFields[$key]['IBLOCK_ID'] != $temp) {
						$kas++;
					} elseif ($arFields[$key]['IBLOCK_ID'] == 34 && $arFields[$key]['PROPERTY_171'] != $temp2) {
						$kas++;
					} elseif ($arFields[$key]['IBLOCK_ID'] == 32 && $arFields[$key]['PROPERTY_180'] != $temp3) {
						$kas++;
					} elseif ($arFields[$key]['IBLOCK_ID'] == 46 && $arFields[$key]['PROPERTY_228'] != $temp4) {
						$kas++;
					}

					$arButtons = CIBlock::GetPanelButtons(
						$arFields[$key]['IBLOCK_ID'],
						$arFields[$key]['ID'],
						0,
						array("SECTION_BUTTONS"=>false, "SESSID"=>false)
					);
					$arFields[$key]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
					$arFields[$key]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

					$arField[$kas]['IBLOCK'] = $arFields[$key]['IBLOCK_ID'];

					if ($arFields[$key]['IBLOCK_ID'] == 34) {
						$arField[$kas]['KEY'] = $arFields[$key]['PROPERTY_171'];
					}

					if ($arFields[$key]['IBLOCK_ID'] == 32) {
						$arField[$kas]['KEY'] = $arFields[$key]['PROPERTY_180'];
					}

					if ($arFields[$key]['IBLOCK_ID'] == 46) {
						$arField[$kas]['KEY'] = $arFields[$key]['PROPERTY_228'];
					}

					$arField[$kas]['ELEMS'][] = $arFields[$key];
					$temp = $arFields[$key]['IBLOCK_ID'];
					$temp2 = $arFields[$key]['PROPERTY_171'];
					$temp3 = $arFields[$key]['PROPERTY_180'];
					$temp4 = $arFields[$key]['PROPERTY_228'];

				}
			}
		}
			
		$breadcrumblos = true;
		
		foreach ($arField as $key=>$Field) {
			
			if ($key == 1 && $Field['IBLOCK'] == 34) {
				$breadcrumblos = false;
			}
			
			if ($Field['IBLOCK'] == 46 && $Field['KEY'] == 73) {
				$FiTemp = [];
				$scha = 0;
				$xkey = 0;
				foreach ($Field['ELEMS'] as $Elem) {
					$FiTemp[$scha][] = $Elem;
					$xkey++;
					if ($xkey == 5) {$scha++;}
				}
				$Field['ELEMS'] = $FiTemp;
			}
			
			if ($Field['IBLOCK'] == 34 || $Field['IBLOCK'] == 44) {
				$Class1 = 'slider-top';
				$Class2 = 'slider-top__item itype1';
			} elseif ($Field['IBLOCK'] == 36) {
				$Class1 = 'galery-block';
				$Class2 = 'gal-bl';
			} elseif ($Field['IBLOCK'] == 32 || $Field['IBLOCK'] == 42) {
				if ($Field['KEY'] == 53) {$Class1 = 'container contents car-opus rgs-3';}
				elseif ($Field['KEY'] == 67) {$Class1 = 'container contents car-opus rgs-4';}
				else {$Class1 = 'container contents car-opus';}
				$Class2 = 'ryad-block';
			} elseif ($Field['IBLOCK'] == 39) {
				$Class1 = 'container contents car-opus rgs-4';
				$Class2 = 'ryad-block';
			} elseif ($Field['IBLOCK'] == 33) {
				$Class1 = 'container text-bl';
				$Class2 = 'content-text';
			} elseif ($Field['IBLOCK'] == 37) {
				$Class1 = 'item-at-container container all_spec-inner at-inner';
				$Class2 = 'at-item';
			} elseif ($Field['IBLOCK'] == 46 && $Field['KEY'] == 73) {
				$Class1 = 'to-ppap-link';
				$Class2 = 'to-row';
			} else {
				$Class1 = '';
				$Class2 = '';
			}
			
			if ($key == 1 && $Class1 != 'slider-top') {$Class1 .= ' margin-top';} 
			
			$img_pos = '';
			
			if (($breadcrumblos == true && $bk != false && $key == 1) || ($breadcrumblos == false && $bk != false && $key == 2)) {
				GetBkOnPg($aply);
			}

			if ($Field['IBLOCK'] == 42 && count($Field['ELEMS']) > 1) {
				$cats = [];
				$mods = [];
				foreach($Field['ELEMS'] as $Elem) {
					
					if ($Elem['PROPERTY_218'] != '' && ($_GET['cat'] == '' || $Elem['PROPERTY_222'] == $_GET['cat'])) {
						$mods[$Elem['PROPERTY_218']] = 'Y';
					} elseif ($Elem['PROPERTY_218'] != '' && $Elem['PROPERTY_222'] != $_GET['cat']) {
						if ($mods[$Elem['PROPERTY_218']] == '') {
							$mods[$Elem['PROPERTY_218']] = 'N';
						}
					}
					
					if ($Elem['PROPERTY_222'] != '' && ($_GET['mod'] == '' || $Elem['PROPERTY_218'] == $_GET['mod'])) {
						$cats[$Elem['PROPERTY_222']] = 'Y';
					} elseif ($Elem['PROPERTY_222'] != '' && $Elem['PROPERTY_218'] != $_GET['mod']) {
						if ($cats[$Elem['PROPERTY_222']] == '') {
							$cats[$Elem['PROPERTY_222']] = 'N';
						}
					}
				}
				
				?>
				<?if (count($mods) > 1 || count($cats) > 1) {?>
					<div class="container">
						<form action="" class="filter_offer">
							<?if (count($cats) > 1) {?>
								<div class="arrowgz">
									<select onChange="window.location='?cat='+this.value<?if ($_GET['mod']) {?>+'&mod=<?=$_GET['mod']?>'<?}?>">
										<option value="">Все категории</option>
										<?foreach ($cats as $key=>$val) {?>
											<?if ($val == 'Y') {?> 
												<option <?if($key == $_GET['cat']){?>selected<?}?> value="<?=str_replace(' ', '%20', $key)?>"><?=$key?></option>
											<?} else {?>
												<option <?if($key == $_GET['cat']){?>selected<?}?> disabled><?=$key?></option>
											<?}?>
										<?}?>
									</select>
								</div>
							<?}?>
							<?if (count($mods) > 1) {?>
								<div class="arrowgz">
									<select onChange="window.location='?mod='+this.value<?if ($_GET['cat']) {?>+'&cat=<?=$_GET['cat']?>'<?}?>">
										<option value="">Все модели</option>
										<?foreach ($mods as $key=>$val) {?>
											<?if ($val == 'Y') {?> 
												<option <?if($key == $_GET['mod']){?>selected<?}?> value="<?=str_replace(' ', '%20', $key)?>"><?=$key?></option>
											<?} else {?>
												<option <?if($key == $_GET['mod']){?>selected<?}?> disabled><?=$key?></option>
											<?}?>
										<?}?>
									</select>
								</div>
							<?}?>
						</form>
					</div>
				<?}?>
				
				<?$emptychar = 'Y';?>
			<?}
			
			

			?><div class="m-bottom <?=$Class1?>"><?
				foreach ($Field['ELEMS'] as $key=>$Elem) {?>
					<?if ($Field['IBLOCK'] == 42) {
						$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/opus.css");
						if ($_GET['cat']) {
							if ($_GET['cat'] != $Elem['PROPERTY_222']) {
								continue;
							}
						}
						
						if ($_GET['mod']) {
							if ($_GET['mod'] != $Elem['PROPERTY_218']) {
								continue;
							}
						}
					}?>
				
					<?if ($Field['KEY'] != 73) {
						$ndfs->AddEditAction($Elem['ID'], $Elem['EDIT_LINK'], CIBlock::GetArrayByID($Elem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$ndfs->AddDeleteAction($Elem['ID'], $Elem['DELETE_LINK'], CIBlock::GetArrayByID($Elem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					}?>
					
					<?if ($Field['IBLOCK'] == 33) {
						if ($Elem['PROPERTY_164'] == 28) {$Class3 = 'tx-al-ri';}
						elseif ($Elem['PROPERTY_164'] == 29) {$Class3 = 'tx-al-ce';}
						elseif ($Elem['PROPERTY_164'] == 30) {$Class3 = 'tx-al-ju';}
						else {$Class3 = '';}
					} else {$Class3 = '';}
					$key_gnum = $key;
					?>
					
					<div class="<?=$Class2?> <?=$Class3?>"<?if ($Field['IBLOCK'] != 46) {?> id="<?=$ndfs->GetEditAreaId($Elem['ID']);?>"<?}?>>
					
						<?if ($Field['IBLOCK'] == 46) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/car360.css");
							if ($Field['KEY'] != 73) {
								
							} else {
								$chet = false;
								if((($key_gnum + 1) % 2) == 0){
									$chet = true;
								}
								$scon = count($Elem);
								foreach ($Elem as $key=>$sEl) {
									
									$ndfs->AddEditAction($sEl['ID'], $sEl['EDIT_LINK'], CIBlock::GetArrayByID($sEl["IBLOCK_ID"], "ELEMENT_EDIT"));
									$ndfs->AddDeleteAction($sEl['ID'], $sEl['DELETE_LINK'], CIBlock::GetArrayByID($sEl["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
									
									$clw = 'to-1-3';
									$clh = 'hg-50';
									$cl2 = 'to-1-3';
									$bst = 0; 
									$bfn = 3;
									if ($scon == 1) {
										$clw = 'to-1-1';
									} elseif ($scon == 2) {
										$clw = 'to-1-2';
									} elseif ($scon == 4 && ($key == 0 || $key == 3)) {
										$clh = 'hg-100';
									} elseif ($scon == 5) {
										$cl2 = 'to-2-3';
										if (!$chet) {
											$bst = 1; 
											$bfn = 4;
										}
										if (($key == 0 && !$chet) || ($key == 4 && $chet)) {
											$clh = 'hg-100';
										}
									}
										
									?>
										
									<?if (($scon == 4 && $key == 1) || ($scon == 5 && $key == $bst)) {?><div class="<?=$cl2?>"><?}?>
									<div class="<?=$clw?>" id="<?=$ndfs->GetEditAreaId($sEl['ID']);?>">
										<a href="javascript:void(0);" data-elem="<?=$sEl['ID']?>" class="<?=$clh?>">
											<img src="<?=CFile::GetPath($sEl['PREVIEW_PICTURE']);?>">
											<div class="to-cont">
												<div class="to-tb">
													<div class="to-tp-zag"><?=$sEl['PROPERTY_227']?></div>
													<div class="to-zag"><?=$sEl['NAME']?></div>
													<div class="to-hd-zag"><?=$sEl['PREVIEW_TEXT']?> &gt;</div>
												</div>
											</div>
										</a>
									</div>
									<?if (($scon == 4 && $key == 2) || ($scon == 5 && $key == $bfn)) {?></div><?}?>
									
									
									
									<div class="poup" data-elems="<?=$sEl['ID']?>" style="background-image:url(<?=CFile::GetPath($sEl['DETAIL_PICTURE']);?>)">
										<div class="po-hedline">
											<i class="po-close"></i>
										</div>
										<div class="po-content">
										
											<?if ($sEl['DETAIL_PICTURE']) {?>
												<div class="padding-cont"></div>
											<?}?>
											
											<div class="white-cont">

												<?GetContByIds($sEl['PROPERTY_226'], $ndfs, $aply, false)?> 

											</div>
										</div>
									</div>
									
									
									
								<?}
							}
						}?>
					
						<?if ($Field['IBLOCK'] == 45) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/car360.css");?>
							<div class="tabulation">
								<div class="preloader hidden" style="background:url(<?=SITE_TEMPLATE_PATH?>/assets/img/Spinner-Preloader.gif);"></div>
								<div class="tab active" data-name="Экстерьер">
									<div class="car-360">
										<div class="target" id="gesuredZone"></div>
										<?foreach ($Elem['PROPERTY_225'] as $key=>$El) {?>
											<img class="imag <?if($key == 0){?>egz-1<?}?>" data-src="<?=CFile::GetPath($El);?>">
										<?}?>
									</div>
								</div>
								<div class="tab" data-name="Интерьер">
									<div id="container-pano"></div>
								</div>
							</div>
							
							<script type="module">
								import * as THREE from '<?=SITE_TEMPLATE_PATH?>/assets/js/tree.js';
								var camera, scene, renderer;
								var isUserInteracting = false,
									onMouseDownMouseX = 0, onMouseDownMouseY = 0,
									lon = 0, onMouseDownLon = 0,
									lat = 0, onMouseDownLat = 0,
									phi = 0, theta = 0;
								init();
								animate();
								function init() {
									var container, mesh;
									container = document.getElementById( 'container-pano' );
									camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 1100 );
									camera.target = new THREE.Vector3( 0, 0, 0 );
									scene = new THREE.Scene();
									var geometry = new THREE.SphereBufferGeometry( 500, 60, 40 );
									// invert the geometry on the x-axis so that all of the faces point inward
									geometry.scale( - 1, 1, 1 );
									var texture = new THREE.TextureLoader().load( '<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>' );
									var material = new THREE.MeshBasicMaterial( { map: texture } );
									mesh = new THREE.Mesh( geometry, material );
									scene.add( mesh );
									renderer = new THREE.WebGLRenderer();
									renderer.setPixelRatio( window.devicePixelRatio );
									renderer.setSize( window.innerWidth, window.innerHeight );
									container.appendChild( renderer.domElement );
									document.getElementById( 'container-pano' ).addEventListener( 'mousedown', onPointerStart, false );
									document.getElementById( 'container-pano' ).addEventListener( 'mousemove', onPointerMove, false );
									document.getElementById( 'container-pano' ).addEventListener( 'mouseup', onPointerUp, false );
									document.getElementById( 'container-pano' ).addEventListener( 'touchstart', onPointerStart, false );
									document.getElementById( 'container-pano' ).addEventListener( 'touchmove', onPointerMove, false );
									document.getElementById( 'container-pano' ).addEventListener( 'touchend', onPointerUp, false );
									window.addEventListener( 'resize', onWindowResize, false );
								}
								function onWindowResize() {
									camera.aspect = window.innerWidth / window.innerHeight;
									camera.updateProjectionMatrix();
									renderer.setSize( window.innerWidth, window.innerHeight );
								}
								function onPointerStart( event ) {
									isUserInteracting = true;
									var clientX = event.clientX || event.touches[ 0 ].clientX;
									var clientY = event.clientY || event.touches[ 0 ].clientY;
									onMouseDownMouseX = clientX;
									onMouseDownMouseY = clientY;
									onMouseDownLon = lon;
									onMouseDownLat = lat;
								}
								function onPointerMove( event ) {
									if ( isUserInteracting === true ) {
										var clientX = event.clientX || event.touches[ 0 ].clientX;
										var clientY = event.clientY || event.touches[ 0 ].clientY;
										lon = ( onMouseDownMouseX - clientX ) * 0.1 + onMouseDownLon;
										lat = ( clientY - onMouseDownMouseY ) * 0.1 + onMouseDownLat;
									}
								}
								function onPointerUp() {
									isUserInteracting = false;
								}
								function animate() {
									requestAnimationFrame( animate );
									update();
								}
								function update() {
									if ( isUserInteracting === false ) {
										lon += 0.1;
									}
									lat = Math.max( - 85, Math.min( 85, lat ) );
									phi = THREE.Math.degToRad( 90 - lat );
									theta = THREE.Math.degToRad( lon );
									camera.target.x = 500 * Math.sin( phi ) * Math.cos( theta );
									camera.target.y = 500 * Math.cos( phi );
									camera.target.z = 500 * Math.sin( phi ) * Math.sin( theta );
									camera.lookAt( camera.target );
									renderer.render( scene, camera );
								}
							</script>
						<?}?>
						
						<?if ($Field['IBLOCK'] == 44) {?>
							<video src="<?=CFile::GetPath($Elem['PROPERTY_224']);?>" controls="" poster="<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>"></video>
						<?}?>
					
						<?if ($Field['IBLOCK'] == 42) {
							$emptychar = 'N';?>
							<div class="r-opus all_l offer">
								<div class="image-car slider-top">
									<div class="image-car-item">
										<div class="img-wrap">
											<img src="<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>" />
										</div>
									</div>
								</div>
								<div class="auto-description__text">
								
									<?if ($Elem['PROPERTY_218']) {?>
										<div class="auto-credit-name-car">VOLVO <?=$Elem['PROPERTY_218']?></div>
									<?}?>
								
									<div class="auto-description-title"><?=$Elem['NAME']?></div>
								
									<?if ($Elem['PREVIEW_TEXT_TYPE'] == 'text') {?>
										<p><?=$Elem['PREVIEW_TEXT']?></p>
									<?} else {?>
										<?=$Elem['PREVIEW_TEXT']?>
									<?}?>
									
									<?if ($Elem['PROPERTY_219'] || $Elem['PROPERTY_220'] || $Elem['PROPERTY_221']) {?>
										<div class="auto-credit-table">
											<?if ($Elem['PROPERTY_219']) {?>
												<div class="auto-credit-table-item">
													<div class="auto-credit-table-name">Специальные цены</div>
													<div class="auto-credit-table-value"><?=$Elem['PROPERTY_219']?></div>
												</div>
											<?}?>
											<?if ($Elem['PROPERTY_220']) {?>
												<div class="auto-credit-table-item">
													<div class="auto-credit-table-name">Trade in</div>
													<div class="auto-credit-table-value"><?=$Elem['PROPERTY_220']?></div>
												</div>
											<?}?>
											<?if ($Elem['PROPERTY_221']) {?>
												<div class="auto-credit-table-item">
													<div class="auto-credit-table-name">Кредитование</div>
													<div class="auto-credit-table-value"><?=$Elem['PROPERTY_221']?></div>
												</div>
											<?}?>
										</div>
									<?}?>
									
									<a href="<?=$Elem['DETAIL_PAGE_URL']?>" class="btn-blue"><span>Подробнее</span></a>
								</div>
							</div>
							
						<?}?>
					
						<?if ($Field['IBLOCK'] == 39) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/opus.css");?>
							<div class="img-wrap so-foto">
								<img src="<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>" />
							</div>
							<div class="so-name"><?=$Elem['NAME']?></div>
							<div class="so-dolz"><?=$Elem['PROPERTY_209']?></div>
						<?}?>
					
						<?if ($Field['IBLOCK'] == 37) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/personal-service.css");
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/popup.css");?>
							
							<div class="at-item-group">
								<div class="at-photo">
									<img class="at-dt" src="<?=CFile::GetPath($Elem['DETAIL_PICTURE']);?>" />
									<img class="at-pr" src="<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>" />
								</div>
								<div class="at-prev">
									<span class="at-name"><?=$Elem["NAME"]?></span>
									<?if ($Elem['PROPERTY_189'] != "") {?>
										<span class="at-phone-d">Телефон:</span>
										<span class="at-phone"><?=$Elem['PROPERTY_189']?></span>
									<?} else {?>
										<span class="at-phone-d">&nbsp;</span>
										<span class="at-phone">&nbsp;</span>
									<?}?>
								</div>
								<div class="at-button">
									<a class="at-btn-href btn-popup" data-id="pt-<?=$Elem["ID"]?>" pname="<?=$Elem["NAME"]?>" href="javascript:void(0)">
										<?=$Elem['PROPERTY_190']?>
									</a>
								</div>
							</div>
							<div class="at-detail">
								<?$phonehrf = str_replace([' ', '(', ')', '-'], '', $Elem['PROPERTY_189'])?>
								<span class="at-name"><b><?=$Elem["NAME"]?></b></span>
								<span class="at-work"><?=$Elem['PROPERTY_192']?></span>
								<?if ($Elem['PROPERTY_189'] != "") {?>
									<span class="at-phone-d"><b>Телефон:</b></span>
									<span class="at-phone"><a href="tel:<?=$phonehrf?>"><?=$Elem['PROPERTY_189']?></a></span>
								<?}?>
								<span class="at-date"><b>Дата рождения:</b> <?=$Elem['PROPERTY_191']?></span>
								<span class="at-obz"><b>Обязанности:</b> <?=$Elem["DETAIL_TEXT"]?></span>
								<span class="at-uvl"><b>Увлекается:</b> <?=$Elem["PREVIEW_TEXT"]?></span>
							</div>
							
							<div class="popup-wrap" id="pt-<?=$Elem["ID"]?>">
								<div class="popup">
									<a href="javascript: void(0);" class="close-popup"></a>
									<div class="title">Запись к специалисту <?=$Elem["NAME"]?></div>
									<div class="desc"></div>
									<form class="aj-form-send" id="form-<?=$Elem["ID"]?>">
										<input type="hidden" name="ttl" value="Запись к специалисту <?=$Elem["NAME"]?>">
										<input type="hidden" name="mailto" value="1">
										<div class="popup-form-item">
											<label for="">Имя</label>
											<input type="text" name="name">
										</div>

										<div class="popup-form-item">
											<label for="">Фамилия</label>
											<input type="text" name="soname">
										</div>

										<div class="popup-form-item">
											<label for="">Телефон</label>
											<input type="tel" name="phone">
										</div>
										
										<div class="popup-form-item">
											<label for="">Желаемая дата и время для записи</label>
											<input type="text" name="pdate">
										</div>
										<button type="submit"><span>Отправить</span></button>
										<p class="call-block__policy-form"></p>
									</form>
								</div>
							</div>
							
						<?}?>
						
						<?if ($Field['IBLOCK'] == 34) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/slick.css");
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/promo-banner.css");
							
							if($Elem['PROPERTY_173'] == 45){$horiA = 'hori_center';}
							elseif($Elem['PROPERTY_173'] == 47) {$horiA = 'hori_right';} 
							else {$horiA = 'hori_left';}
							
							if($Elem['PROPERTY_172'] == 43){$vertA = 'vert_top';}
							elseif($Elem['PROPERTY_172'] == 44) {$vertA = 'vert_bottom';} 
							else {$vertA = 'vert_center';}
							
							if ($Field['KEY'] != 40) {$atTypeb = "image-bl";} 
							else {$atTypeb = '';}?>
								<div class="img-wrap <?=$atTypeb?> <?=GetListValueById($Elem['PROPERTY_207'])?>">
									<img class="slider-top__item--im" src="<?=CFile::GetPath($Elem['PREVIEW_PICTURE']);?>" />
								</div>
								<div class="slider-top__content-wrap <?=$vertA?> <?=$horiA?>">
									<div class="slider-top__content">
										<?if ($Elem['PROPERTY_177'] != '') {?>
											<div class="slider-top-name"><?=$Elem['PROPERTY_177']?></div>
										<?}?>
										<?if ($Elem['PROPERTY_178'] != 51) {?>
											<?if ($Elem['PROPERTY_181'] == 54) {?>
												<h1 class="slider-top-title"><?=$Elem['NAME']?></h1>
											<?} elseif ($Elem['PROPERTY_181'] == 55) {?>
												<h2 class="slider-top-title"><?=$Elem['NAME']?></h2>
											<?} else {?>
												<div class="slider-top-title"><?=$Elem['NAME']?></div>
											<?}?>
										<?}?>
										<?if ($Elem['PREVIEW_TEXT'] != '') {?>
											<div class="slider-top-desc"><?=$Elem['PREVIEW_TEXT']?></div>
										<?}?>
										<?if ($Elem['PROPERTY_174'] == 48 && $Elem['PROPERTY_175'] != '') {?>
											<a href="<?=$Elem['PROPERTY_176']?>" class="btn-def"><span><?=$Elem['PROPERTY_175']?></span></a>
										<?} elseif ($Elem['PROPERTY_174'] == 49 && $Elem['PROPERTY_175'] != '') {?>
											<a href="javascript:void(0);" onclick="<?=$Elem['PROPERTY_176']?>" class="btn-def"><span><?=$Elem['PROPERTY_175']?></span></a>
										<?}?>
										
									</div>
								</div>
						<?}?>
						
						
						<?if ($Field['IBLOCK'] == 33) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/text-block.css");?>
							
							<?if ($Elem['PROPERTY_168'] == 34) {$tx_sty = 'tx-bold';} 
							elseif ($Elem['PROPERTY_168'] == 35) {$tx_sty = 'tx-ital';} 
							elseif ($Elem['PROPERTY_168'] == 36) {$tx_sty = 'tx-bold-ital';} 
							else {$tx_sty = '';}?>
							
							<?if ($Elem['PROPERTY_169'] == 37) {$tx_sty .= ' upper';}?>
							
							<?if ($Elem['PROPERTY_186'] != '') {?>
								<div class="finance-item__title"><?=$Elem['PROPERTY_186']?></div>
							<?}?>
							
							<?if ($Elem['PROPERTY_163'] == 26) {?>
								<?if ($Elem['PROPERTY_183'] == 58) {?>
									<h1 class="title <?=$tx_sty?>"><?=$Elem['NAME']?></h1>
								<?} elseif ($Elem['PROPERTY_183'] == 59) {?>
									<h2 class="title <?=$tx_sty?>"><?=$Elem['NAME']?></h2>
								<?} else {?>
									<div class="title <?=$tx_sty?>"><?=$Elem['NAME']?></div>
								<?}?>
							<?}?>
							
							<?if ($Elem['PREVIEW_TEXT_TYPE'] == 'text') {?>
								<p><?=$Elem['PREVIEW_TEXT']?></p>
							<?} else {?>
								<?=$Elem['PREVIEW_TEXT']?>
							<?}?>
							
							<?if ($Elem['PROPERTY_165'] == 31 && $Elem['PROPERTY_167'] != '') {?>
								<a class="btn-blue" href="<?=$Elem['PROPERTY_166']?>"><?=$Elem['PROPERTY_167']?></a>
							<?} elseif ($Elem['PROPERTY_165'] == 32 && $Elem['PROPERTY_167'] != '') {?>
								<a class="btn-blue" href="javascript:void(0);" onclick="<?=$Elem['PROPERTY_166']?>"><?=$Elem['PROPERTY_167']?></a>
							<?}?>
							
						<?}?>
						<?if ($Field['IBLOCK'] == 32) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/opus.css");
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/slick.css");
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/promo-banner.css");
							
							if ($Elem['PROPERTY_180'] == 53) {
								$dsgb_2 = 'ryad3';
								$img_pos = '';
							} elseif ($Elem['PROPERTY_180'] == 67) {
								$dsgb_2 = 'ryad4';
								$img_pos = '';
							} else {
								$dsgb_2 = 'r-opus';
								if ($img_pos == '') {
									if ($Elem['PROPERTY_187'] == 64) {$img_pos = 'all_r';} 
									elseif ($Elem['PROPERTY_187'] == 62) {$img_pos = 'fst_r';} 
									elseif ($Elem['PROPERTY_187'] == 63) {$img_pos = 'all_l';} 
									else {$img_pos = 'fst_l';}
								}
							}
							
							if ($Elem['PROPERTY_188'] == 66) {$dsgb_1 = 'im-contain';} 
							else {$dsgb_1 = '';}
							?>
							<div class="<?=$dsgb_2?> <?=$img_pos?>">
								<div class="image-car slider-top">
									<?foreach ($Elem['PROPERTY_158'] as $pic) {?>
										<div class="image-car-item">
											<div class="img-wrap <?=$dsgb_1?> <?=GetListValueById($Elem['PROPERTY_208'])?>">
												<img src="<?=CFile::GetPath($pic);?>" />
											</div>
										</div>
									<?}?>
								</div>
								<div class="auto-description__text">
								
									<?if ($Elem['PROPERTY_184'] != 60) {?>
										<?if ($Elem['PROPERTY_182'] == 56) {?>
											<h1 class="auto-description-title"><?=$Elem['NAME']?></h1>
										<?} elseif ($Elem['PROPERTY_182'] == 57) {?>
											<h2 class="auto-description-title"><?=$Elem['NAME']?></h2>
										<?} else {?>
											<div class="auto-description-title"><?=$Elem['NAME']?></div>
										<?}?>
									<?}?>
								
									<?if ($Elem['PREVIEW_TEXT_TYPE'] == 'text') {?>
										<p><?=$Elem['PREVIEW_TEXT']?></p>
									<?} else {?>
										<?=$Elem['PREVIEW_TEXT']?>
									<?}?>
									
									<?if ($Elem['PROPERTY_159'] == 24 && $Elem['PROPERTY_161'] != '') {?>
										<a href="<?=$Elem['PROPERTY_160']?>" class="btn-blue"><span><?=$Elem['PROPERTY_161']?></span></a>
									<?} elseif ($Elem['PROPERTY_159'] == 25 && $Elem['PROPERTY_161'] != '') {?>
										<a href="javascript:void(0);" onclick="<?=$Elem['PROPERTY_160']?>" class="btn-blue"><span><?=$Elem['PROPERTY_161']?></span></a>
									<?}?>
									
								</div>
							</div>
						<?}?>
						<?if ($Field['IBLOCK'] == 36) {
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/galery-block.css");
							$aply->SetAdditionalCss(SITE_TEMPLATE_PATH . "/assets/css/fancybox.css");?>
							<div class="g-row">
								<?foreach ($Elem['PROPERTY_185'] as $key=>$pic) {?>
								
									<?if ($key == 4 || $key == 6) {$bpclass = 'medium';} 
									elseif ($key == 7) {$bpclass = 'large';} 
									else {$bpclass = 'small';}?>
									
									<a class="fancybox img-wrap <?=$bpclass?>" data-fancybox="gallery" rel="group" href="<?=CFile::GetPath($pic);?>">
										<img class="gallery_img" src="<?=CFile::GetPath($pic);?>" alt="">
									</a>
									
									<?if ($key == 2 || $key == 4 || $key == 6) {?>
										</div><div class="g-row">
									<?}?>
								<?}?>
							</div>
						<?}?>
						
						
					</div>
				<?}
				if ($Field['IBLOCK'] == 42 && $emptychar == 'Y') {?>
						<div class="container emp-text">Ничего не найдено.</div>
				<?}
			?></div><?
		}
		
		if (($breadcrumblos == false && $bk != false && !$arField[2] && $aply->GetCurPage(false) !== '/') || (!$ID && $aply->GetCurPage(false) !== '/')) {
			GetBkOnPg($aply);
		}

		return null;
	}
?>