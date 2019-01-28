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
<?if (0 < $arResult["SECTIONS_COUNT"]){?>
<div class="catalog__tags" style="display: none">
    <div class="tags">
        <div class="tags__list">
            <?foreach ($arResult['SECTIONS'] as $arSection){?>
            <div class="tags__item">
                <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="button button_theme_tag active">
                    <span class="button__text"><?=$arSection['NAME']?></span>
                </a>
            </div>
            <?}?>
        </div>
    </div>
</div>
<?};?>
