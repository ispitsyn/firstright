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
<div class="card-category card-category_catalog">
    <div class="card-category__box section">
        <div class="card-category__header h-content">
            <?if('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID']) {
                $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                ?>
                <h2 class="card-category__title" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
                    <a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>">
                        <?echo (isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
                            ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
                            : $arResult['SECTION']['NAME']
                        );?></a>
                </h2>
            <?}?>
        </div>
        <nav class="card-category__list-wrap">
            <ul class="card-category__list">
                <?foreach ($arResult['SECTIONS'] as &$arSection){
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                if (false === $arSection['PICTURE'])
                    $arSection['PICTURE'] = array(
                        'SRC' => $arCurView['EMPTY_IMG'],
                        'ALT' => (
                        '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
                            ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
                            : $arSection["NAME"]
                        ),
                        'TITLE' => (
                        '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
                            ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
                            : $arSection["NAME"]
                        )
                    );
                ?>
                <li class="card-category__item card-category__item_catalog" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <a class="card-category__item-link" href="<?=$arSection['SECTION_PAGE_URL'];?>">
                        <div class="card-category__item-view">
                            <img class="card-category__item-image" src="<?=$arSection['PICTURE']['SRC'];?>" alt="<?=$arSection['NAME'];?>" role="presentation"/>
                        </div>
                        <div class="card-category__item-info">
                            <p class="card-category__item-name"><?=$arSection['NAME'];?></p>
                            <?if ('' != $arSection['DESCRIPTION']) {?>
                                <p class="card-category__item-description"><? echo $arSection['DESCRIPTION']; ?></p>
                            <?}?>
                        </div>
                    </a>
                </li>
                <?}?>
            </ul>
        </nav>
    </div>
</div>
<?};?>