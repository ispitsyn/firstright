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
<? if (count($arResult["ITEMS"])) { ?>
    <section class="entry-list section">
        <div class="entry-list__box section__box">
            <ul class="entry-list__list">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="entry-list__item">
                    <a href="<?= $arItem['DETAIL_PAGE_URL']?>" class="entry-card" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                        <div class="entry-card__view">
                            <img class="entry-card__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" role="presentation"/>
                        </div>
                        <div class="entry-card__info">
                            <div class="entry-card__statistic">
                                <span class="entry-card__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                                <span class="entry-card__views"><svg class="svg-icon"><use xlink:href="#eye"></use></svg><?=$arItem['SHOW_TEXT']?></span>
                            </div>
                            <h3 class="entry-card__title"><?=$arItem['NAME']?></h3>
                            <p class="entry-card__text"><?=$arItem['PREVIEW_TEXT']?></p>
                        </div>
                    </a>
                </li>
                <? endforeach; ?>
                <div class="entry-list__item"></div>
                <div class="entry-list__item"></div>
                <div class="entry-list__item"></div>
            </ul>
        </div>
    </section>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
<? } ?>
