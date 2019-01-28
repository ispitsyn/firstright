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
    <section class="special-offer special-offer_ind">
        <div class="special-offer__box section">
            <div class="h-content">
                <h2 class="special-offer__title"><?=$arParams['PAGER_TITLE']?></h2>
            </div>
            <ul class="special-offer__list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="special-offer__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                    <a class="special-offer__item-box" href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>">
                    <?else:?>
                    <div class="special-offer__item-box">
                    <?endif;?>
                        <div class="special-offer__item-info">
                            <?if(strlen($arItem['PROPERTIES']['TITLE']['VALUE'])):?>
                            <h3 class="special-offer__item-header"><?=$arItem['PROPERTIES']['TITLE']['VALUE'];?></h3>
                            <?endif;?>
                            <?if(strlen($arItem['PROPERTIES']['DESCRIPTION']['VALUE'])):?>
                            <p class="special-offer__item-description"><?=$arItem['PROPERTIES']['DESCRIPTION']['VALUE'];?></p>
                            <?endif;?>
                            <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE']) || strlen($arItem['PROPERTIES']['PRICE_LAST']['VALUE'])):?>
                            <div class="special-offer__price-box">
                                <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE'])):?>
                                <p class="special-offer__price special-offer__price_new b-price">
                                    <span><?=number_format(floatval($arItem['PROPERTIES']['PRICE']['VALUE']),0,',',' ');?></span>
                                </p>
                                <?endif;?>
                                <?if(strlen($arItem['PROPERTIES']['PRICE_LAST']['VALUE'])):?>
                                <p class="special-offer__price special-offer__price_last b-price b-price_old">
                                    <span><?=number_format(floatval($arItem['PROPERTIES']['PRICE_LAST']['VALUE']),0,',',' ');?></span>
                                </p>
                                <?endif;?>
                            </div>
                            <?endif;?>
                        </div>
                        <span class="special-offer__item-view" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>');"></span>
                    <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                    </a>
                    <?else:?>
                    </div>
                    <?endif;?>
                </li>
            <?endforeach;?>
            </ul>
        </div>
    </section>
<?endif;?>
