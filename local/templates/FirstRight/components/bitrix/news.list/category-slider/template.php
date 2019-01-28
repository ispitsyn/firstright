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
    <section class="category-slider category-slider_ind">
        <div class="category-slider__box section">
            <div class="category-slider__header">
                <h2 class="section__title">Актуальные категории</h2>
            </div>
            <ul class="category-slider__list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="category-slider__item">
                    <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="category-slider__item-box">
                        <div class="category-slider__item-view">
                            <img class="category-slider__item-image" itemprop="image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" role="presentation"/>
                        </div>
                        <div class="category-slider__item-info">
                            <h3 class="category-slider__item-name"><?=$arItem['NAME']?></h3>
                            <div class="category-slider__price-box">
                                <p class="category-slider__item-price b-price"><span>От <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0,',',' ');?></span></p>
                            </div>
                        </div>
                    </a>
                </li>
            <?endforeach;?>
            </ul>
        </div>
    </section>
<?endif;?>
