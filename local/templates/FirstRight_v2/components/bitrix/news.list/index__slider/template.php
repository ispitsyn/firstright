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
$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"])):?>
    <section class="slider-full">
        <ul class="slider-full__list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="slider-full__item <?echo strlen($arItem['PROPERTIES']['THEME']['VALUE_XML_ID']) ? 'slider-full__item_'.$arItem['PROPERTIES']['THEME']['VALUE_XML_ID'] : '';?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                <a class="slider-full__item-link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>">
                <?else:?>
                <div class="slider-full__item-link">
                <?endif;?>
                    <div class="slider-full__item-view" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')"></div>
                    <div class="slider-full__item-info">
                        <?if(strlen($arItem['PROPERTIES']['TITLE']['VALUE'])):?>
                            <h3 class="slider-full__item-title"><?=$arItem['PROPERTIES']['TITLE']['VALUE'];?></h3>
                        <?endif;?>
                        <?if(strlen($arItem['PROPERTIES']['DESCRIPTION']['VALUE'])):?>
                            <p class="slider-full__item-description"><?=$arItem['PROPERTIES']['DESCRIPTION']['VALUE'];?></p>
                        <?endif;?>
                        <?if(strlen($arItem['PROPERTIES']['REMARK']['VALUE'])):?>
                            <p class="slider-full__item-remark"><?=$arItem['PROPERTIES']['REMARK']['VALUE'];?></p>
                        <?endif;?>
                    </div>
                <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                </a>
                <?else:?>
                </div>
                <?endif;?>
            </li>
        <?endforeach;?>
        </ul>
        <div class="slider-full__controls"></div>
    </section>
<?endif;?>
