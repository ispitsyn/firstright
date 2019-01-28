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
<?if (0 < $arResult["SECTIONS_COUNT"]){?>
<div class="catalog__tags-category">
    <section class="tags-category">
        <div class="tags-category__box section">
            <ul class="tags-category__list">
            <?foreach ($arResult['SECTIONS'] as $arSection){?>
                <li class="tags-category__item">
                    <a class="tags-category__item-box" href="<?=$arSection['SECTION_PAGE_URL'];?>">
                        <span class="tags-category__name"><?=$arSection['NAME']?></span>
                    </a>
                </li>
            <?}?>
            </ul>
        </div>
    </section>
</div>
<?};?>