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
$APPLICATION->SetPageProperty('page_type','product');
$GLOBALS['OG_IMG'] = $arResult['GALLERY']['ORIGINAL'][0];
$DISCOUNT_PRICE = $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] ? $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] : 0;
$PRINT_DISCOUNT_PRICE = $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] ? $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] : 0;
?>
<script>
    var pageParams = {
        price: <?=$DISCOUNT_PRICE;?>
    }
</script>
<section class="product-page" id="product">
    <div class="product-page__box">
        <div class="product-page__header section">
            <h1 class="product-page__title"><?=$arResult['NAME']?></h1>
            <div class="product-page__labels">
                <div class="detail-labels">
                    <ul class="detail-labels__list">
                        <li class="detail-labels__item detail-labels__item_news">
                            <span>новинка</span>
                        </li>
                        <li class="detail-labels__item detail-labels__item_top">
                            <span>популярное</span>
                        </li>
                        <li class="detail-labels__item detail-labels__item_sale">
                            <span>скидка</span>
                        </li>
                        <li class="detail-labels__item detail-labels__item_trade">
                            <span>trade-in</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-page__main section">
            <div class="product-page__view">
                <div class="product-slider">
                    <ul class="product-slider__main">
                        <?foreach ($arResult['GALLERY']['ORIGINAL'] as $key => $itemImage):?>
                            <li class="product-slider__main-item" v-on:click="dialogProductSlider = true;">
                                <img class="product-slider__main-image" src="<?=$itemImage?>" alt="" role="presentation"/>
                            </li>
                        <?endforeach;?>
                    </ul>
                    <ul class="product-slider__nav">
                        <?foreach ($arResult['GALLERY']['MIN'] as $itemImage):?>
                            <li class="product-slider__nav-item"><img class="product-slider__nav-image" src="<?=$itemImage['src']?>" alt="" role="presentation"/></li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
            <div class="product-page__info">
                <?if(count($arResult['PRODUCT_OPTIONS'])):?>
                    <div class="product-page__options">
                    <? foreach ($arResult['PRODUCT_OPTIONS'] as $PRODUCT_OPTION) {?>
                        <div class="options-group <?echo strlen($PRODUCT_OPTION['code']) ? 'options-group_'.$PRODUCT_OPTION['code'] : '';?> product-page__options-group">
                            <p class="options-group__name"><?=$PRODUCT_OPTION['name']?></p>
                            <div class="options-group__list <?echo strlen($PRODUCT_OPTION['code']) ? 'options-group__list_'.$PRODUCT_OPTION['code'] : '';?>">
                                <? foreach ($PRODUCT_OPTION['items'] as $property) {?>
                                    <?switch ($PRODUCT_OPTION['code']){
                                        case 'color':?>
                                            <?if(!$property['current']):?>
                                                <a href="<?=$property['link']?>"
                                                   class="options-group__option options-group__option_color"
                                                   style="background-image: url('<?=$property['src']?>');">
                                                </a>
                                            <?else:?>
                                                <div class="options-group__option options-group__option_color active"
                                                     style="background-image: url('<?=$property['src']?>');">
                                                </div>
                                            <?endif;?>
                                            <?break;
                                        default:?>
                                            <div class="options-group__option options-group__option_btn">
                                                <?if(!$property['current']):?>
                                                    <a href="<?=$property['link']?>" class="btn btn_prod-opt waves-effect"><span><?=$property['value']?></span></a>
                                                <?else:?>
                                                    <div class="btn btn_prod-opt btn_prod-opt-disable waves-effect"><span><?=$property['value']?></span></div>
                                                <?endif;?>
                                            </div>
                                    <?}?>
                                <?}?>
                            </div>
                        </div>
                    <?}?>
                    </div>
                <?endif;?>
                <div class="product-page__spoiler">
                    <div class="product-spoiler">
                        <div class="product-spoiler__list">
                            <div class="product-spoiler__item">
                                <label class="product-spoiler__item-header active"><span class="product-spoiler__item-check-box"><input class="product-spoiler__item-check" type="radio" name="set" value="" checked="checked" @change="detailCurrentPrice = <?=$DISCOUNT_PRICE;?>"/><span class="product-spoiler__item-checked"></span></span>
                                    <p class="product-spoiler__item-header-box"><span class="product-spoiler__item-title">Стандартный комплект</span><span class="product-spoiler__item-price b-price"><span><?=number_format($PRINT_DISCOUNT_PRICE, 0, ',', ' ');?></span></span></p>
                                </label>
                                <?if(strlen(trim($arResult['PROPERTIES']['STANDARD_SET']['VALUE']))):?>
                                <div class="product-spoiler__item-info open">
                                    <p class="product-spoiler__item-description"><?=htmlspecialcharsBack(trim($arResult['PROPERTIES']['STANDARD_SET']['VALUE']))?></p>
                                </div>
                                <?endif;?>
                            </div>
                            <? foreach ($arResult['OFFERS'] as $OFFER) {?>
                            <div class="product-spoiler__item">
                                <label class="product-spoiler__item-header"><span class="product-spoiler__item-check-box"><input class="product-spoiler__item-check" type="radio" name="set" value="" @change="detailCurrentPrice = <?=number_format($OFFER['PRICES']['BASE']['DISCOUNT_VALUE'], 0, ',', ' ');?>"/><span class="product-spoiler__item-checked"></span></span>
                                    <p class="product-spoiler__item-header-box"><span class="product-spoiler__item-title"><?=$OFFER['NAME']?></span><span class="product-spoiler__item-price"><?=number_format($OFFER['PRICES']['BASE']['PRINT_DISCOUNT_VALUE'], 0, ',', ' ');?></span></p>
                                </label>
                                <div class="product-spoiler__item-info">
                                    <p class="product-spoiler__item-description"><?=htmlspecialcharsBack(trim($OFFER['DETAIL_TEXT']))?></p>
                                </div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="product-page__buy">
                    <p class="product-page__buy-price b-price">
                        <span>{{detailCurrentPrice}}</span>
                    </p>
                    <div class="product-page__buy-btn"
                         @click="callBackForm.name = 'Оформить заказ на <?=$arResult['NAME']?>';dialogTableVisible = true;">
                        <div class="btn btn_prod-buy waves-effect"><span>Оформить заказ</span></div>
                    </div>
                </div>
                <ul class="product-page__delivery">
                    <li class="product-page__delivery-item"><span class="product-page__delivery-icon product-page__delivery-icon_moscow"></span><span class="product-page__delivery-name">Доставка курьером по Москве (пт. 19.11)</span><span class="product-page__delivery-price">бесплатно</span>
                    </li>
                    <li class="product-page__delivery-item"><span class="product-page__delivery-icon product-page__delivery-icon_country"></span><span class="product-page__delivery-name">Доставка по России (до 10 дней)</span><span class="product-page__delivery-price">290 рублей</span>
                    </li>
                </ul>
            </div>
        </div>
        <?if(
            strlen(trim($arResult['DETAIL_TEXT'])) ||
            !empty($arResult['PROPERTIES']['CHARACTERISTICS_DESCRIPTION']['VALUE'])
        ):?>
        <div class="product-page__add">
            <div class="section">
            <el-tabs v-model="productTabsActive" @tab-click="handleClick">
                <?if(strlen(trim($arResult['DETAIL_TEXT']))):?>
                <el-tab-pane label="Описание" name="first">
                    <div class="product-tab product-tab_description">
                        <div class="content-page__content">
                            <?=$arResult['DETAIL_TEXT']?>
                        </div>
                    </div>
                </el-tab-pane>
                <?endif;?>

                <?if(!empty($arResult['PROPERTIES']['CHARACTERISTICS_DESCRIPTION']['VALUE'])):?>
                    <el-tab-pane label="Характеристики" name="second">
                    <div class="product-tab product-tab_characteristics">
                        <div class="characteristics">
                                <div class="characteristics__header">
                                    <div class="characteristics__title">Основные характеристики
                                    </div>
                                </div>
                                <div class="characteristics__blocks">
                                    <? foreach ($arResult['PROPERTIES']['CHARACTERISTICS_DESCRIPTION']['VALUE'] as $characteristic_key=>$CHARACTERISTIC) {?>
                                        <div class="characteristics__block">
                                            <div class="characteristics__block-name"><?=$arResult['PROPERTIES']['CHARACTERISTICS_DESCRIPTION']['DESCRIPTION'][$characteristic_key];?></div>
                                            <div class="characteristics__block-content">
                                                <?=trim(htmlspecialcharsBack($CHARACTERISTIC['TEXT']))?>
                                            </div>
                                        </div>
                                    <?}?>
                                </div>
                        </div>
                    </div>
                </el-tab-pane>
                <?endif;?>

                <?if(false):?>
                <el-tab-pane label="Аксессуары" name="third">
                    <section class="card-slider card-slider_product">
                        <h2 class="card-slider__header">
                        </h2>
                        <ul class="card-slider__list">
                            <li class="card-slider__item">
                                <div class="product-card">
                                    <div class="product-card__box" itemscope="itemscope" itemtype="http://schema.org/Product">
                                        <div class="product-card__view"><img class="product-card__img" itemprop="image"src="<?=SITE_TEMPLATE_PATH?>/images/products/iphone_7.jpg" alt="" role="presentation"/>
                                        </div>
                                        <div class="product-card__info">
                                            <h3 class="product-card__name"><span itemprop="brand">Apple </span><span itemprop="name">iPhone 7 128Gb <br/>Black</span>
                                            </h3>
                                            <p class="product-card__description h-content" itemprop="description">Суппер товар
                                            </p>
                                            <div class="product-card__price-box" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
                                                <div class="product-card__price b-price">
                                                    <meta itemprop="priceCurrency" content="RUB"/>
                                                    <span itemprop="price">41 990</span>
                                                </div>
                                                <p class="product-card__price product-card__price_old b-price b-price_old">
                                                    <span>49 990</span>
                                                </p>
                                            </div>
                                            <div class="product-card__btn">
                                                <div class="btn btn_product-card waves-effect"><span>Купить</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </section>
                </el-tab-pane>
                <?endif;?>
            </el-tabs>
            </div>
        </div>
        <?endif;?>
        <el-dialog title="<?=$arResult['NAME']?>" lock-scroll :visible.sync="dialogProductSlider" fullscreen="fullscreen" custom-class="popup_product-slider">
            <div class="popup-product-slider">
                <div class="popup-product-slider__main">
                    <ul class="popup-product-slider__list">
                        <?foreach ($arResult['GALLERY']['ORIGINAL'] as $itemImage):?>
                            <li class="product-slider__main-item">
                                <img class="product-slider__main-image" src="<?=$itemImage?>" alt="" role="presentation"/>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
                <div class="popup-product-slider__footer">
                    <ul class="popup-product-slider__list-navigation">
                        <?foreach ($arResult['GALLERY']['MIN'] as $itemImage):?>
                            <li class="product-slider__nav-item"><img class="product-slider__nav-image" src="<?=$itemImage['src']?>" alt="" role="presentation"/></li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
        </el-dialog>
    </div>
</section>
