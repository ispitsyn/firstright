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
    <section class="category-group category-group_mod_ind section">
        <div class="category-group__box section__box">
            <div class="category-group__header section__header">
                <div class="category-group__title section__title">Актуальные категории
                </div>
            </div>
            <nav class="category-group__main">
                <ul class="category-group__list">
                    <?foreach($arResult["ITEMS"] as $arItem){?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="category-group__item">
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="category-card"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="category-card__view">
                                    <img class="category-card__image" itemprop="image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" role="presentation"/>
                                </div>
                                <div class="category-card__info">
                                    <h3 class="category-card__name"><?=$arItem['NAME']?></h3>
                                    <div class="category-card__price-box">
                                        <p class="category-card__price b-price">От <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0,',',' ');?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?}?>
                </ul>
            </nav>
            <div class="category-group__footer section__footer"></div>
        </div>
    </section>
<?endif;?>
