<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$colorSchemes = array(
    "green" => "bx-green",
    "yellow" => "bx-yellow",
    "red" => "bx-red",
    "blue" => "bx-blue",
);
if(isset($colorSchemes[$arParams["TEMPLATE_THEME"]]))
{
    $colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"]];
}
else
{
    $colorScheme = "";
}
?>

<div class="catalog__pagination">
    <section class="pagination">
        <div class="pagination__box">
            <div class="pagination__controls">
                <?if ($arResult["NavPageNomer"] > 1):?>
                <?if($arResult["bSavePage"]):?>
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__control pagination__control_prev button button_theme_pagination">
                    <span class="button__text"><?echo GetMessage("round_nav_back")?></span>
                </a>
                <ol class="pagination__list">
                    <li class="pagination__item pagination__item_active"><a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a></li>
                    <?else:?>
                <?if ($arResult["NavPageNomer"] > 2):?>
                    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__control pagination__control_prev button button_theme_pagination">
                        <span class="button__text"><?echo GetMessage("round_nav_back")?></span>
                    </a>
                    <ol class="pagination__list">
                        <?else:?>
                        <a class="pagination__control pagination__control_prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?echo GetMessage("round_nav_back")?></a>
                        <ol class="pagination__list">
                            <?endif?>
                            <li class="pagination__item">
                                <a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
                            </li>
                            <?endif?>
                            <?else:?>
                            <ol class="pagination__list">
                                <li class="pagination__item pagination__item_active"><span class="pagination__link">1</span></li>
                                <?endif?>

                                <?$arResult["nStartPage"]++;
                                while($arResult["nStartPage"] <= $arResult["nEndPage"]-1):?>
                                    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                                        <li class="pagination__item pagination__item_active">
                                            <span class="pagination__link"><?=$arResult["nStartPage"]?></span>
                                        </li>
                                    <?else:?>
                                        <li class="pagination__item">
                                            <a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
                                        </li>
                                    <?endif?>
                                    <?$arResult["nStartPage"]++?>
                                <?endwhile?>

                                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                                <?if($arResult["NavPageCount"] > 1):?>
                                    <li class="pagination__item">
                                        <a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
                                    </li>
                                <?endif?>
                            </ol>
                            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagination__control pagination__control_next button button_theme_pagination">
                                <span class="button__text"><?echo GetMessage("round_nav_forward")?></span>
                            </a>
                            <?else:?>
                            <?if($arResult["NavPageCount"] > 1):?>
                            <li class="pagination__item pagination__item_active"><span class="pagination__link"><?=$arResult["NavPageCount"]?></span></li>
                        </ol>
                    <?endif?>
                    </ol>
                <?endif?>
            </div>
        </div>
    </section>
</div>
