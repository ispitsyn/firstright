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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<?if (0 < $arResult["SECTIONS_COUNT"]) {?>
    <div class="card-category card-category_repair">
        <div class="card-category__box section">
            <ul class="card-category__list">
                <?foreach ($arResult['SECTIONS'] as $arSection) {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
                    <li class="card-category__item card-category__item_repair" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                        <a class="card-category__item-link" href="<?=$arSection['FIRST_SECTION_LINK'] !== null ? $arSection['FIRST_SECTION_LINK'] : $arSection['SECTION_PAGE_URL'];?>">
                            <? if (is_array($arSection["PICTURE"]) && $arSection["PICTURE"]['SRC'] !== ''):?>
                            <div class="card-category__item-view">
                                <img class="card-category__item-image" src="<?=$arSection["PICTURE"]['SRC']?>" alt="<?=$arSection["PICTURE"]['ALT']?>" role="presentation"/>
                            </div>
                            <?endif;?>
                            <div class="card-category__item-info">
                                <p class="card-category__item-name"><?=$arSection["NAME"]?></p>
                                <p class="card-category__item-description"></p>
                            </div>
                        </a>
                    </li>
                <?}?>
            </ul>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
    	"bitrix:main.include",
    	".default",
    	array(
    		"COMPONENT_TEMPLATE" => ".default",
    		"PATH" => SITE_DIR."/include/general/advantages_part-1.php",
    		"AREA_FILE_SHOW" => "file",
    		"AREA_FILE_SUFFIX" => "",
    		"AREA_FILE_RECURSIVE" => "Y",
    		"EDIT_TEMPLATE" => ""
    	),
    	false,
    	array('HIDE_ICONS' => 'Y')
    );?>
    <div class="content-box">
        <div class="content-box__box section">
            <?=$arResult['SECTION']['DESCRIPTION'];?>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."/include/general/advantages_part-2.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => ""
        ),
        false,
        array('HIDE_ICONS' => 'Y')
    );?>
<?}?>