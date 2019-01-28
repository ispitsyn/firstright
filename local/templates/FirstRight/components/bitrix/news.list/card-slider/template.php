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
    <section class="card-slider card-slider_ind">
        <div class="card-slider__box section">
            <div class="card-slider__header">
                <h2 class="section__title"><?=$arParams['PAGER_TITLE']?></h2>
            </div>
            <ul class="card-slider__list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="card-slider__item">
                    <a class="product-card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <div class="product-card__box" itemscope="itemscope" itemtype="http://schema.org/Product">
                            <div class="product-card__view">
                                <img class="product-card__img" itemprop="image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" role="presentation"/>
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__name">
                                    <span class="h-content" itemprop="brand"><?=$arItem['PROPERTIES_BRAND_VALUE']?></span>
                                    <span itemprop="name"><?=$arItem['NAME']?></span>
                                </h3>
                                <div class="product-card__price-box" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
                                    <div class="product-card__price b-price">
                                        <meta itemprop="priceCurrency" content="RUB"/>
                                        <span itemprop="price"><?=number_format($arItem['PRICE']['BASE']['VALUE'],0,',',' ')?></span>
                                    </div>
                                    <?if(
                                            $arItem['PROPERTIES']['IS_DISCOUNT']['VALUE_XML_ID'] === 'Y' &&
                                            floatval($arItem['PROPERTIES']['DISCOUNT_AMOIUNT']['VALUE']) > 0
                                    ):?>
                                    <p class="product-card__price product-card__price_old b-price b-price_old">
                                        <span><?=number_format(($arItem['PROPERTIES']['PRICE']['VALUE'] + $arItem['PROPERTIES']['DISCOUNT_AMOIUNT']['VALUE']),0,',',' ')?></span>
                                    </p>
                                    <?endif;?>
                                </div>
                                <div class="product-card__btn">
                                    <div class="btn btn_product-card waves-effect" @click="dialogTableVisible = true" data-id="<?=$arItem['ID']?>"><span>Оформить</span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?endforeach;?>
            </ul>
            <div class="card-slider__footer">
                <a href="<?=$arParams['LINK_ALL']?>" class="btn btn_card-slider-all waves-effect"><span><?=$arParams['TEXT_BUTTON_ALL']?></span></a>
            </div>
        </div>
    </section>
<?endif;?>
