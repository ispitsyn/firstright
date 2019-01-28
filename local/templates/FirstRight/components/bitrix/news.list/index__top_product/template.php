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
            <h2 class="card-slider__header">Популярные товары</h2>
            <ul class="card-slider__list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="card-slider__item">
                    <div class="product-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="product-card__box" itemscope="itemscope" itemtype="http://schema.org/Product">
                            <div class="product-card__view">
                                <img class="product-card__img" itemprop="image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" role="presentation"/>
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__name">
                                    <span itemprop="brand">Apple </span><span itemprop="name">iPhone 7 128Gb <br/>Black</span>
                                </h3>
                                <p class="product-card__description h-content" itemprop="description">Суппер товар</p>
                                <div class="product-card__price-box" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
                                    <div class="product-card__price b-price">
                                        <meta itemprop="priceCurrency" content="RUB"/>
                                        <span itemprop="price"><?=$arItem['PROPERTIES']['PRICE']['VALUE'];?></span>
                                    </div>
                                    <p class="product-card__price product-card__price_old b-price b-price_old">
                                        <span><?=$arItem['PROPERTIES']['PRICE_OLD']['VALUE'];?></span>
                                    </p>
                                </div>
                                <div class="product-card__btn">
                                    <div class="btn btn_product-card waves-effect"><span>Купить</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?endforeach;?>
            </ul>
        </div>
    </section>
<?endif;?>
