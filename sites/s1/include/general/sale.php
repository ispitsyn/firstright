<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;
$GLOBALS['saleFilter'] = ["PROPERTY_IS_DISCOUNT_VALUE" => "Да"];
$custom_sort = 'N';
if (!empty($_REQUEST["sort"])) {
    $custom_sort = 'Y';
    if ($_REQUEST["sort"] == "name" ||
        $_REQUEST["sort"] == "show_counter" ||
        $_REQUEST["sort"] == "property_price") {
        $custom_sort = 'Y';
        $arParams["ELEMENT_SORT_FIELD"] = $_REQUEST["sort"];
        $arParams["ELEMENT_SORT_ORDER"] = $_REQUEST["method"];
    };
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
        'TYPE' => 'property_price',
        'DIR' => 'asc',
        'NAME' => 'по возрастанию цены',
    ],
    [
        'TYPE' => 'property_price',
        'DIR' => 'desc',
        'NAME' => 'по убыванию цены',
    ],
];
if ($custom_sort === 'N') $arSort[1]['ACTIVE'] = 'Y';?>
<section class="sort sort_product">
    <div class="sort__box section">
        <ul class="sort__list">
            <?
            $currentGet = $_GET;
            if (isset($currentGet['sort']) && isset($currentGet['method'])) {
                if (isset($currentGet['sort'])) unset($currentGet['sort']);
                if (isset($currentGet['method'])) unset($currentGet['method']);
            }
            $currentGet = '?' . http_build_query($currentGet, '', '&');
            foreach ($arSort as $itemSort):
                $current_active = $itemSort['TYPE'] === $_REQUEST['sort'] &&
                $itemSort['DIR'] === $_REQUEST['method'] ||
                $itemSort['ACTIVE'] === 'Y' ? ' active' : '';
                ?>
                <li class="sort__item">
                    <a class="sort__link btn btn_sort<?= $current_active; ?>"
                       href="<?= $APPLICATION->GetCurPage() . $currentGet . '&sort=' . $itemSort['TYPE'] . '&method=' . $itemSort['DIR']; ?>">
                        <span class="sort__item-text"><?= $itemSort['NAME'] ?></span>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</section>
<section class="catalog">
    <div class="catalog__box section">
        <div class="catalog__filter">
            <section class="catalog-filter bx-filter">
                <? if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '') $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
                $arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

                $isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
                $isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
                $isFilter = ($arParams['USE_FILTER'] == 'Y');

                if ($isFilter) {

                    $arFilter = array(
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ACTIVE" => "Y",
                        "GLOBAL_ACTIVE" => "Y",
                    );

                    if (0 < intval($arResult["VARIABLES"]["SECTION_ID"])) $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
                    elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"]) $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

                    $obCache = new CPHPCache();

                    if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
                        $arCurSection = $obCache->GetVars();
                    } elseif ($obCache->StartDataCache()) {
                        $arCurSection = array();

                        if (Loader::includeModule("iblock")) {
                            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

                            if (defined("BX_COMP_MANAGED_CACHE")) {
                                global $CACHE_MANAGER;
                                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                                if ($arCurSection = $dbRes->Fetch())
                                    $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

                                $CACHE_MANAGER->EndTagCache();
                            } else {
                                if (!$arCurSection = $dbRes->Fetch())
                                    $arCurSection = array();
                            }
                        }
                        $obCache->EndDataCache($arCurSection);

                    }

                    if (!isset($arCurSection)) $arCurSection = array();
                } ?>
                <? if ($isFilter): ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "qw",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arCurSection['ID'],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SAVE_IN_SESSION" => "N",
                            "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                            "XML_EXPORT" => "Y",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            "SEF_MODE" => $arParams["SEF_MODE"],
                            "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                            "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                            "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    ); ?>
                <? endif ?>
            </section>
        </div>
        <div class="catalog__grid-cards">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "product",
                Array(
                    "ACTION_VARIABLE" => "action",
                    "ADD_PICT_PROP" => "-",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BACKGROUND_IMAGE" => "-",
                    "BASKET_URL" => "/personal/basket.php",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COMPATIBLE_MODE" => "Y",
                    "DETAIL_URL" => "#SITE_DIR#/#ELEMENT_CODE#/",
                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_COMPARE" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "ENLARGE_PRODUCT" => "STRICT",
                    "FILTER_NAME" => "saleFilter",
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "catalog",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "LABEL_PROP" => array(),
                    "LAZY_LOAD" => "N",
                    "LINE_ELEMENT_COUNT" => "3",
                    "LOAD_ON_SCROLL" => "N",
                    "MESSAGE_404" => "",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "OFFERS_LIMIT" => "0",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Товары",
                    "PAGE_ELEMENT_COUNT" => "24",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRICE_CODE" => array("PRICE"),
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPERTIES" => array(),
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                    "PROPERTY_CODE" => array("PRICE", "BRAND", "IS_DISCOUNT", ""),
                    "PROPERTY_CODE_MOBILE" => array("PRICE", "BRAND", "IS_DISCOUNT"),
                    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                    "RCM_TYPE" => "personal",
                    "SECTION_CODE" => "",
                    "SECTION_ID" => "",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("", ""),
                    "SEF_MODE" => "N",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "Y",
                    "SHOW_404" => "N",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "SHOW_FROM_SECTION" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "SHOW_SLIDER" => "Y",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "USE_MAIN_ELEMENT_SECTION" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N"
                )
            );
            ?>
        </div>
    </div>
</section>
