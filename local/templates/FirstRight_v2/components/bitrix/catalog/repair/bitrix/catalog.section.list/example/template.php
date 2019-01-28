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
    <section class="category-group category-group_mod_repair section">
        <div class="category-group__box section__box">
            <div class="category-group__header section__header"></div>
            <nav class="category-group__main">
                <ul class="category-group__list">
                    <?foreach ($arResult['SECTIONS'] as $arSection) {
                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
                        <li class="category-group__item">
                            <a class="category-card category-card_mod_repair" href="<?=$arSection['FIRST_SECTION_LINK'] !== null ? $arSection['FIRST_SECTION_LINK'] : $arSection['SECTION_PAGE_URL'];?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                                <? if (is_array($arSection["PICTURE"]) && $arSection["PICTURE"]['SRC'] !== ''):?>
                                    <div class="category-card__view">
                                        <img class="category-card__image" src="<?=$arSection["PICTURE"]['SRC']?>" alt="<?=$arSection["PICTURE"]['ALT']?>" role="presentation"/>
                                    </div>
                                <?endif;?>
                                <div class="category-card__info">
                                    <p class="category-card__name"><?=$arSection["NAME"]?></p>
                                </div>
                            </a>
                        </li>
                    <?}?>
                </ul>
            </nav>
            <div class="category-group__footer section__footer"></div>
        </div>
    </section>
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
    <section class="section">
        <div class="section__box">
            <div class="section__main">
                <div class="content">
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR . "include/repair/about.php",
                        Array(),
                        Array(
                            "NAME" => "",
                            "MODE" => "html")
                    );?>
                    <?if(false){?>
                        <?=$arResult['SECTION']['DESCRIPTION'];?>
                    <?}?>
                </div>
            </div>
        </div>
    </section>
<?}?>
