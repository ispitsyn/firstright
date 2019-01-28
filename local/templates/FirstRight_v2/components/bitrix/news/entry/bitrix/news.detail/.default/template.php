<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<section class="entry-detail">
    <div class="entry-detail__cover section section_grey">
        <div class="entry-detail__cover-box section__box">
            <img class="entry-detail__cover-image" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" role="presentation"/>
            <svg class="svg-icon"><use xlink:href="#logo_footer"></use></svg>
        </div>
    </div>
    <div class="entry-detail__content section">
        <div class="section__box">
            <div class="entry-detail__header">
                <a href="<?=$arResult["LIST_PAGE_URL"]?>" class="entry-detail__close">
                    <svg class="svg-icon"><use xlink:href="#close"></use></svg>
                </a>
                <div class="entry-detail__statistic">
                    <span class="entry-detail__date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
                    <span class="entry-detail__views"><svg class="svg-icon"><use xlink:href="#eye"></use></svg><?=$arResult['SHOW_TEXT']?></span>
                </div>
                <h1 class="entry-detail__title"><?=$arResult['NAME']?></h1>
                <p class="entry-detail__description"><?=$arResult['PREVIEW_TEXT']?></p>
                <?if(count($arResult['TAGS'])){?>
                    <div class="entry-detail__tags-and-socials">
                        <nav class="tag-group">
                            <ul class="tag-group__list">
                                <?foreach($arResult['TAGS'] as $arTag){?>
                                    <li class="tag-group__item">
                                        <a class="tag" href="javascript:void(0);">
                                            <span class="tag__text"><?= $arTag ?></span>
                                        </a>
                                    </li>
                                <?}?>
                            </ul>
                        </nav>
                    </div>
                <?}?>
            </div>
            <div class="entry-detail__main">
                <div class="content"><?=$arResult['DETAIL_TEXT']?></div>
            </div>
        </div>
    </div>
</section>
