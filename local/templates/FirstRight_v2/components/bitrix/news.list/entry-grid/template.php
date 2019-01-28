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
$this->setFrameMode(true); ?>
<? if (count($arResult["ITEMS"])): ?>
    <section class="entry-grid section section_grey">
        <div class="entry-grid__box section__box">
            <div class="entry-grid__header section__header">
                <h2 class="entry-grid__title section__title"><?=$arParams['PAGER_TITLE'];?></h2>
                <?if(isset($arParams['PAGER_DESCRIPTION'])){?>
                    <p class="entry-grid__description section__description"><?=$arParams['PAGER_DESCRIPTION'];?></p>
                <?}?>
            </div>
            <div class="entry-grid__main">
                <div class="entry-grid__grid">
                <? $first = true;
                foreach ($arResult["ITEMS"] as $arItem){?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="entry-grid__item <?if($first){?>entry-grid__item_main<?}?>">
                        <div class="entry-card <?if($first){?>entry-card_main<?}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="entry-card__view">
                                <img class="entry-card__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" role="presentation"/>
                            </div>
                            <div class="entry-card__info">
                                <div class="entry-card__statistic">
                                    <span class="entry-card__date"><?= $arItem['DISPLAY_ACTIVE_FROM']?></span>
                                    <span class="entry-card__views"><svg class="svg-icon"><use xlink:href="#eye"></use></svg><?=$arItem['SHOW_TEXT']?></span>
                                </div>
                                <h3 class="entry-card__title"><?if(!$first){?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?}?><?=$arItem['NAME']?><?if(!$first){?></a><?}?></h3>
                                <p class="entry-card__description"><?=$arItem['PREVIEW_TEXT']?></p>
                                <?if($first){?>
                                <div class="entry-card__button">
                                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button button_theme_entry-card">
                                        <span class="button__text">Подробнее</span>
                                    </a>
                                </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <?$first = false;?>
                <?}?>
                    <div class="entry-grid__item"></div>
                    <div class="entry-grid__item"></div>
                    <div class="entry-grid__item"></div>
                    <div class="entry-grid__item"></div>
                </div>
            </div>
            <div class="entry-grid__footer section__footer">
                <a href="<?=$arResult['SECTION_PAGE_URL'];?>" class="button button_theme_show-all-grey">
                    <span class="button__text">Показать все</span>
                </a>
            </div>
        </div>
    </section>
<? endif; ?>
