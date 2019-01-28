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
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));?>
<?if (0 < $arResult["SECTIONS_COUNT"]) {?>
    <div class="repair__navigation">
        <section class="repair-navigation">
            <div class="repair-navigation__box section">
                <ul class="repair-navigation__list">
                <?foreach ($arResult['SECTIONS'] as $arSection) {?>
                    <li class="repair-navigation__item <?if($arSection['SELECT']){?>repair-navigation__item_active<?}?>">
                    <?if($arSection['SELECT']){?>
                        <div class="repair-navigation__item-link">
                    <?} else {?>
                        <a class="repair-navigation__item-link" href="<?=$arSection['SECTION_PAGE_URL'];?>">
                    <?}?>
                            <?=htmlspecialcharsBack($arSection['UF_SVG_ICON_CODE']);?>
                            <span class="repair-navigation__item-name"><?=$arSection["NAME"]?></span>
                    <?if($arSection['SELECT']){?>
                        </div>
                    <?} else {?>
                        </a>
                    <?}?>
                    </li>
                <?}?>
                </ul>
            </div>
        </section>
    </div>
<?}?>

