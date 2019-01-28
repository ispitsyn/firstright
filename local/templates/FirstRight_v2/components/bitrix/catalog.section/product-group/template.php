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
    <section class="product-group product-group_ind section">
        <div class="product-group__box section__box">
            <div class="product-group__header section__header">
                <h2 class="product-group__title section__title"><?=$arParams['TITLE']?></h2>
            </div>
            <div class="product-group__main">
                <ul class="product-group__list">
                <?foreach($arResult["ITEMS"] as $arItem){?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $buttonArr = [
                        'button' => [
                            'type' => 'card',
                            'theme' => 'button_theme_product-card'
                        ],
                        'product' => [
                            'id' => $arItem['ID'],
                            'name' => htmlspecialchars($arItem['NAME']),
                            'image' => $arItem['PREVIEW_PICTURE']['SRC'],
                            'url' => $arItem['DETAIL_PAGE_URL'],
                            'price' => $arItem['PRICES']['BASE']['DISCOUNT_VALUE'],
                            'priceLast' => $arItem['PRICES']['BASE']['VALUE'],
                            'quantity' => 1
                        ]
                    ];
                    ?>
                    <li class="product-group__item">
                        <a class="product-card" href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" itemscope="itemscope" itemtype="http://schema.org/Product">
                            <div class="product-card__view">
                                <img class="product-card__image"
                                     itemprop="image"
                                     src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                                     alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>"
                                     role="presentation"
                                />
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__name" itemprop="name"><?=$arItem['NAME']?></h3>
                                <div class="product-card__price-box" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
                                    <div class="product-card__price">
                                        <meta itemprop="priceCurrency" content="RUB"/>
                                        <span class="b-price" itemprop="price"><?=number_format($arItem['ITEM_PRICES'][0]['PRICE'], 0, '.', ' ');?></span>
                                    </div>
                                    <?if($arItem['ITEM_PRICES'][0]['PRICE'] < $arItem['ITEM_PRICES'][0]['BASE_PRICE']){?>
                                        <p class="product-card__price product-card__price_old">
                                            <span class="b-price_old"><?=number_format($arItem['ITEM_PRICES'][0]['BASE_PRICE'], 0, '.', ' ');?></span>
                                        </p>
                                    <?};?>
                                </div>
                                <div class="product-card__button">
                                    <div class="vue-component" data-component="buttonBuy" data-initial='<?=json_encode($buttonArr, JSON_UNESCAPED_UNICODE);?>'></div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?}?>
                    <li class="product-group__item"></li>
                    <li class="product-group__item"></li>
                    <li class="product-group__item"></li>
                    <li class="product-group__item"></li>
                </ul>
            </div>
            <div class="product-group__footer section__footer">
                <a class="button button_theme_show-all" href="<?=$arParams['LINK_ALL']?>">
                    <span class="button__text">Показать все</span>
                </a>
            </div>
        </div>
    </section>
<?endif;?>
