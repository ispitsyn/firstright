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
    <section class="promo-group promo-group_ind section">
        <div class="promo-group__box section__box">
            <div class="h-content">
                <h2 class="promo-group__title">Акции</h2>
            </div>
            <ul class="promo-group__list">
            <?foreach($arResult["ITEMS"] as $arItem){?>
                <?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                <li class="promo-group__item">
                    <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                    <a class="promo-card" href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?else:?>
                    <div class="promo-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?endif;?>
                        <div class="promo-card__info">
                            <?if(strlen($arItem['PROPERTIES']['TITLE']['VALUE'])):?>
                            <h3 class="promo-card__title"><?=$arItem['PROPERTIES']['TITLE']['VALUE'];?></h3>
                            <?endif;?>
                            <?if(strlen($arItem['PROPERTIES']['DESCRIPTION']['VALUE'])):?>
                            <p class="promo-card__description"><?=$arItem['PROPERTIES']['DESCRIPTION']['VALUE'];?></p>
                            <?endif;?>
                            <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE']) || strlen($arItem['PROPERTIES']['PRICE_LAST']['VALUE'])):?>
                            <div class="promo-card__price-box">
                                <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE'])):?>
                                <p class="promo-card__price promo-card__price_new b-price"><?=number_format(floatval($arItem['PROPERTIES']['PRICE']['VALUE']),0,',',' ');?></p>
                                <?endif;?>
                                <?if(strlen($arItem['PROPERTIES']['PRICE_LAST']['VALUE'])):?>
                                <p class="promo-card__price promo-card__price_last b-price b-price_old"><?=number_format(floatval($arItem['PROPERTIES']['PRICE_LAST']['VALUE']),0,',',' ');?></p>
                                <?endif;?>
                            </div>
                            <?endif;?>
                        </div>
                        <div class="promo-card__view" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')"></div>
                    <?if(strlen($arItem['PROPERTIES']['LINK']['VALUE'])):?>
                    </a>
                    <?else:?>
                    </div>
                    <?endif;?>
                </li>
            <?}?>
            </ul>
        </div>
    </section>
<?endif;?>
