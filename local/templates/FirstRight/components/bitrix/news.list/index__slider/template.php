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
    <div class="full-slider full-slider_ind">
        <ul class="full-slider__list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="full-slider__item <?echo strlen($arItem['PROPERTIES']['THEME']['VALUE_XML_ID']) ? 'full-slider__item_'.$arItem['PROPERTIES']['THEME']['VALUE_XML_ID'] : '';?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                <a class="full-slider__item-link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>">
                <?else:?>
                <div class="full-slider__item-link">
                <?endif;?>
                    <div class="full-slider__item-info">
                        <?if(strlen($arItem['PROPERTIES']['TITLE']['VALUE'])):?>
                        <h3><?=$arItem['PROPERTIES']['TITLE']['VALUE'];?></h3>
                        <?endif;?>
                        <?if(strlen($arItem['PROPERTIES']['DESCRIPTION']['VALUE'])):?>
                        <p><span class="full-slider__item-info-description"><?=$arItem['PROPERTIES']['DESCRIPTION']['VALUE'];?></span><p>
                        <?endif;?>
                        <?if(strlen($arItem['PROPERTIES']['REMARK']['VALUE'])):?>
                        <p><span class="full-slider__item-info-remark"><?=$arItem['PROPERTIES']['REMARK']['VALUE'];?></span></p>
                        <?endif;?>
                    </div>
                    <div class="full-slider__item-view" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>');"></div>
                <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                </a>
                <?else:?>
                </div>
                <?endif;?>
            </li>
            <?endforeach;?>
        </ul>
        <div class="full-slider__controls"></div>
    </div>
<?endif;?>