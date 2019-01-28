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
$APPLICATION->SetPageProperty('page_type','news-item');
?>
<section class="news-item">
    <div class="news-item__cover section">
        <img class="news-item__cover-image" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" role="presentation"/>
    </div>
    <div class="news-item__content">
        <div class="news-item__close"></div>
        <div class="news-item__header">
            <div class="news-item__statistic">
                <div class="statistic-row">
                    <div class="statistic-row__item statistic-row__item_date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
                    <div class="statistic-row__item statistic-row__item_shows"><?=$arResult['SHOW_TEXT']?></div>
                </div>
            </div>
            <h1 class="news-item__title"><?=$arResult['NAME']?></h1>
            <p class="news-item__description"><?=$arResult['PREVIEW_TEXT']?></p>
            <?if(count($arResult['TAGS'])){?>
                <div class="news-item__tags-and-socials">
                    <nav class="tags">
                        <ul class="tags__list">
                            <?foreach ($arResult['TAGS'] as $arTag) {?>
                            <li class="tags__item"><a class="tag-item" href="javascript:void(0);"><span class="tag-item__name"><?=$arTag?></span></a></li>
                            <?}?>
                        </ul>
                    </nav>
                </div>
            <?}?>
        </div>
        <div class="news-item__main">
            <div class="content"><?=$arResult['DETAIL_TEXT']?></div>
        </div>
    </div>
</section>