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
$titles = array('товар', 'товара', 'товаров');
function declOfNum($number, $titles)
{
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number." ".$titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
}
$custom_sort = 'N';
if(!empty($_REQUEST["sort"]))
{
    $custom_sort = 'Y';
    if ($_REQUEST["sort"] == "name" ||
        $_REQUEST["sort"] == "active_from" ||
        $_REQUEST["sort"] == "show_counter" ||
        $_REQUEST["sort"] == "catalog_PRICE_1")
    {
        $custom_sort = 'Y';
        $arParams["ELEMENT_SORT_FIELD"] = $_REQUEST["sort"];
        $arParams["ELEMENT_SORT_ORDER"] = $_REQUEST["method"];
    }
}
$arSort = [
    [
        'TYPE' => 'name',
        'DIR' => 'asc',
        'NAME' => 'по названию'
    ],
    [
        'TYPE' => 'active_from',
        'DIR' => 'desc',
        'NAME' => 'по новизне',
    ],
    [
        'TYPE' => 'show_counter',
        'DIR' => 'desc',
        'NAME' => 'по популярности',
    ],
    [
        'TYPE' => 'catalog_PRICE_1',
        'DIR' => 'asc,nulls',
        'NAME' => 'по возрастанию цены',
    ],
    [
        'TYPE' => 'catalog_PRICE_1',
        'DIR' => 'desc',
        'NAME' => 'по убыванию цены',
    ],
];
if($custom_sort !== 'Y') {
    $_REQUEST['sort'] = $arSort[1]['TYPE'];
    $_REQUEST['method'] = $arSort[1]['DIR'];
}?>
<div class="catalog">
    <div class="catalog__header">
        <div class="catalog__search">
            <?$arElements = $APPLICATION->IncludeComponent(
                "bitrix:search.page",
                ".default",
                Array(
                    "RESTART" => $arParams["RESTART"],
                    "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
                    "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                    "arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
                    "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
                    "USE_TITLE_RANK" => "N",
                    "DEFAULT_SORT" => "rank",
                    "FILTER_NAME" => "",
                    "SHOW_WHERE" => "N",
                    "arrWHERE" => array(),
                    "SHOW_WHEN" => "N",
                    "PAGE_RESULT_COUNT" => 50,
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "N",
                ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );?>
        </div>
        <?if (!empty($arElements) && is_array($arElements)) {?>
        <div class="catalog__sort">
            <div class="sort">
                <div class="sort__box section__box">
                    <div class="sort__list">
                        <?foreach ($arSort as $sortKey => $itemSort) {
                            $current_active = $itemSort['TYPE'] === $_REQUEST['sort'] && $itemSort['DIR'] === $_REQUEST['method'] ? ' active' :  '';
                            $link = $sortKey !== 1 ? $APPLICATION->GetCurDir().'?sort='.$itemSort['TYPE'].'&method='.$itemSort['DIR'] : $APPLICATION->GetCurDir();
                            ?>
                            <div class="sort__item">
                                <a href="<?=$link;?>" class="button button_theme_sort<?=$current_active;?>">
                                    <span class="button__text"><?=$itemSort['NAME']?></span>
                                </a>
                            </div>
                        <?};?>
                    </div>
                </div>
            </div>
        </div>
        <?}?>
    </div>
    <div class="catalog__main">
        <div class="catalog__box section__box">
        <?if (!empty($arElements) && is_array($arElements)) {?>
            <div class="catalog__title"><span>По запросу «iPhone» найдено <?=declOfNum(count($arElements),$titles);?></span></div>
            <div class="catalog__layout">
                <?global $searchFilter;
                $searchFilter = array("=ID" => $arElements);
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                        "SECTION_URL" => $arParams["SECTION_URL"],
                        "DETAIL_URL" => $arParams["DETAIL_URL"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                        "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                        "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                        "HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "FILTER_NAME" => "searchFilter",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_USER_FIELDS" => array(),
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "META_KEYWORDS" => "",
                        "META_DESCRIPTION" => "",
                        "BROWSER_TITLE" => "",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                    ),
                    $arResult["THEME_COMPONENT"],
                    array('HIDE_ICONS' => 'Y')
                );?>
            </div>
        <?} elseif (is_array($arElements)) {
            echo GetMessage("CT_BCSE_NOT_FOUND");
        }?>
        </div>
    </div>
</div>

