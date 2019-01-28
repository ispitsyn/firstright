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
$PRINT_DISCOUNT_PRICE = $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] ? $arResult['PRICES']['BASE']['DISCOUNT_VALUE'] : 0;?>
<script>var pageParams = {price: <?=$DISCOUNT_PRICE;?>}</script>
<section class="product-detail">
    <div class="product-detail__header section">
        <div class="product-detail__header-box section__box"><h1 class="product-detail__title"><?=$arResult['NAME']?></h1>
            <div class="product-detail__labels">
                <div class="labels labels_detail">
                    <ul class="labels__list">
                        <li class="labels__item labels__item_new"><span>новинка</span></li>
                        <li class="labels__item labels__item_top"><span>популярное</span></li>
                        <li class="labels__item labels__item_sale"><span>скидка</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-detail__main">
        <div class="product-detail__main-box section__box">
            <div class="product-detail__view">
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
            <div class="product-detail__info product-detail__info_stretch">
                <?if(count($arResult['PRODUCT_OPTIONS'])):?>
                    <div class="product-detail__info-section product-detail__info-section_options">
                        <? foreach ($arResult['PRODUCT_OPTIONS'] as $PRODUCT_OPTION) {?>
                            <div class="option-group <?echo strlen($PRODUCT_OPTION['code']) ? 'option-group_'.$PRODUCT_OPTION['code'] : '';?> product-page__option-group">
                                <p class="option-group__name"><?=$PRODUCT_OPTION['name']?></p>
                                <div class="option-group__list <?echo strlen($PRODUCT_OPTION['code']) ? 'option-group__list_'.$PRODUCT_OPTION['code'] : '';?>">
                                    <? foreach ($PRODUCT_OPTION['items'] as $property) {?>
                                        <?switch ($PRODUCT_OPTION['code']){
                                            case 'color':?>
                                                <?if(!$property['current']):?>
                                                    <a href="<?=$property['link']?>"
                                                       class="option-group__option option-group__option_color"
                                                       style="background-image: url('<?=$property['src']?>');">
                                                    </a>
                                                <?else:?>
                                                    <div class="option-group__option option-group__option_color active"
                                                         style="background-image: url('<?=$property['src']?>');">
                                                    </div>
                                                <?endif;?>
                                                <?break;
                                            default:?>
                                                <div class="option-group__option option-group__option_btn">
                                                    <?if(!$property['current']):?>
                                                        <a href="<?=$property['link']?>" class="button button_theme_product-option"><span class="button__text"><?=$property['value']?></span></a>
                                                    <?else:?>
                                                        <div class="button button_theme_product-option active"><span class="button__text"><?=$property['value']?></span></div>
                                                    <?endif;?>
                                                </div>
                                            <?}?>
                                    <?}?>
                                </div>
                            </div>
                        <?}?>
                    </div>
                <?endif;?>
                <div class="product-detail__info-section product-detail__info-section_spoiler">
                    <div class="product-spoiler">
                        <div class="product-spoiler__list">
                            <div class="product-spoiler__item">
                                <label class="product-spoiler__item-header active"><span class="product-spoiler__item-check-box"><input class="product-spoiler__item-check" type="radio" name="set" value="" checked="checked" @change="detailCurrentPrice = <?=$DISCOUNT_PRICE;?>"/><span class="product-spoiler__item-checked"></span></span>
                                    <p class="product-spoiler__item-header-box"><span class="product-spoiler__item-title">Стандартный комплект</span><span class="product-spoiler__item-price b-price"><span><?=number_format($PRINT_DISCOUNT_PRICE, 0, ',', ' ');?></span></span></p>
                                </label>
                                <?$standardSet_description = $arResult['PROPERTIES']['STANDARD_SET']['VALUE'];
                                if(is_array($standardSet_description)) $standardSet_description = $standardSet_description['TEXT'];
                                if(!empty($standardSet_description) && strlen(trim($standardSet_description))):?>
                                    <div class="product-spoiler__item-info open">
                                        <p class="product-spoiler__item-description"><?=trim($standardSet_description)?></p>
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
                <div class="product-detail__info-section product-detail__info-section_buy">
                    <div class="product-detail__price-box">
                        <p class="product-detail__price b-price"><?=number_format($arResult['PRICES']['BASE']['DISCOUNT_VALUE'], 0, '.', ' ');?></p>
                        <?if($arResult['PRICES']['BASE']['DISCOUNT_VALUE'] < $arResult['PRICES']['BASE']['VALUE']){?>
                        <p class="product-detail__price product-detail__price_last b-price b-price_old"><?=number_format($item['PRICES']['BASE']['VALUE'], 0, '.', ' ');?></p>
                        <?}?>
                    </div>
                    <div class="product-detail__buy">
                        <?$buttonArr = [
                            'button' => [
                                'type' => 'detail',
                                'theme' => 'button_theme_product-detail'
                            ],
                            'product' => [
                                'id' => $arResult['ID'],
                                'name' => htmlspecialchars($arResult['NAME']),
                                'image' => $arResult['PREVIEW_PICTURE']['SRC'],
                                'url' => $arResult['DETAIL_PAGE_URL'],
                                'price' => $arResult['PRICES']['BASE']['DISCOUNT_VALUE'],
                                'priceLast' => $arResult['PRICES']['BASE']['VALUE'],
                                'quantity' => 1
                            ]
                        ];?>
                        <div class="vue-component" data-component="buttonBuy" data-initial='<?=json_encode($buttonArr, JSON_UNESCAPED_UNICODE);?>'></div>
                    </div>
                </div>
                <div class="product-detail__info-section product-detail__info-section_delivery">
                    <div class="product-detail__delivery">
                        <span class="product-detail__delivery-icon product-detail__delivery-icon_moscow"></span>
                        <span class="product-detail__delivery-name">Доставка курьером по Москве (пт. 19.11)</span>
                        <span class="product-detail__delivery-price">бесплатно</span>
                    </div>
                    <div class="product-detail__delivery">
                        <span class="product-detail__delivery-icon product-detail__delivery-icon_country"></span>
                        <span class="product-detail__delivery-name">Доставка по России (до 10 дней)</span>
                        <span class="product-detail__delivery-price">290 рублей</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-detail__add section section_grey">
        <div class="product-detail__add-box section__box">
            <div class="tabs">
                <div class="tabs__navigation">
                    <div class="button button_theme_tab active"><span class="button__text">Описание</span></div>
                    <div class="button button_theme_tab"><span class="button__text">Характеристики</span></div>
                    <?if(false){?><div class="button button_theme_tab"><span class="button__text">Аксессуары</span></div><?}?>
                    <div class="button button_theme_tab"><span class="button__text">Доставка и оплата</span></div>
                    <div class="button button_theme_tab"><span class="button__text">Обмен и возврат</span></div>
                </div>
                <div class="tabs__list">
                    <div class="tabs__item active">
                        <div class="content"><?=$arResult['DETAIL_TEXT']?></div>
                    </div>
                    <div class="tabs__item">
                        <table class="characteristics">
                            <tbody>
                            <?$content = $arResult['PROPERTIES']['CHARACTERISTICS_DESCRIPTION']['CONTENT'];
                            if(!empty($content)) {
                                foreach ($content as $keySection => $section) {
                                    ?>
                                    <tr>
                                        <th><span><?= $keySection ?></span></th>
                                    </tr>
                                    <?
                                    foreach ($section as $keyItem => $item) {
                                        ?>
                                        <tr>
                                            <td><span><?= $keyItem ?></span></td>
                                            <td><span><?=nl2br($item)?></span></td>
                                        </tr>
                                    <?
                                    } ?>
                                <?
                                }
                            }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tabs__item">
                        <div class="content">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."/include/general/delivery-and-pay.php",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "html"
                            ),
                            false,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                        </div>
                    </div>
                    <div class="tabs__item">
                        <div class="content">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."/include/general/return.php",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "html"
                            ),
                            false,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__footer"></div>
        </div>
    </div>
</section>

