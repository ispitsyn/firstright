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
<?if(count($arResult["ITEMS"])){?>
<section class="problems-list">
    <div class="problems-list__box section">
        <div class="problems-list__header">
            <h2 class="problems-list__title section__title">Или выберите поломку</h2>
        </div>
        <div class="problems-list__list">
        <?foreach ($arResult["ITEMS"] as $arItem) {?>
            <div class="problems-list__item">
                <div class="problem-item problem-item_border">
                    <div class="problem-item__info">
                        <a class="problem-item__name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                        <?if(strlen(trim($arItem['PREVIEW_TEXT']))){?>
                            <div class="problem-item__description"><?=$arItem['PREVIEW_TEXT']?></div>
                        <?}?>
                    </div>
                    <div class="problem-item__params">
                        <div class="problem-item__price">от 19 990р.</div>
                    </div>
                </div>
            </div>
        <?}?>
            <div class="problems-list__item"></div>
            <div class="problems-list__item"></div>
            <div class="problems-list__item"></div>
        </div>
    </div>
</section>
<?};?>