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
<section class="repair-group repair-group_problem section">
    <div class="repair-group__box section__box">
        <div class="repair-group__header section__header">
            <h2 class="repair-group__title section__title">Или выберите поломку</h2>
        </div>
        <nav class="repair-group__main">
            <ul class="repair-group__list">
                <?foreach ($arResult["ITEMS"] as $arItem) {?>
                    <li class="repair-group__item">
                        <div class="repair-card repair-card_problem">
                            <div class="repair-card__info">
                                <a class="repair-card__title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                                <?if(strlen(trim($arItem['PREVIEW_TEXT']))){?>
                                    <div class="repair-card__description"><?=$arItem['PREVIEW_TEXT']?></div>
                                <?}?>
                            </div>
                            <div class="repair-card__params">
                                <div class="repair-card__price">от 19 990р.</div>
                            </div>
                        </div>
                    </li>
                <?}?>
            </ul>
        </nav>
        <div class="repair-group__footer section__footer"></div>
    </div>
</section>
<?};?>
