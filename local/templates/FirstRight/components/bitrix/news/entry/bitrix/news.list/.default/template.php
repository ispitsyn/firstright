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
    <section class="entries">
        <div class="entries__box section">
            <div class="entries__list">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="entries__item">
                    <div class="entry-preview" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                        <a class="entry-preview__box" href="<?= $arItem['DETAIL_PAGE_URL']?>">
                            <div class="entry-preview__view">
                                <img class="entry-preview__view-img" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME']?>">
                            </div>
                            <div class="entry-preview__info">
                                <div class="entry-preview__statistic">
                                    <span class="entry-preview__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                                    <span class="entry-preview__views"><?=$arItem['SHOW_COUNTER'] ? $arItem['SHOW_COUNTER'] : '0'?></span>
                                </div>
                                <h3 class="entry-preview__title"><?=$arItem['NAME']?></h3>
                                <p class="entry-preview__text"><?=$arItem['PREVIEW_TEXT']?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <? endforeach; ?>
                <div class="entries__item"></div>
                <div class="entries__item"></div>
                <div class="entries__item"></div>
            </div>
        </div>
    </section>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
<? } ?>