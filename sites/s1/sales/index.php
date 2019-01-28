<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('page_type','sales');
$APPLICATION->SetTitle("Скидки");
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
    <section class="catalog">
        <div class="catalog__header">
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
        </div>
        <div class="catalog__main">
            <div class="catalog__box section__box">
                <div class="catalog__layout">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	".default",
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
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
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:6:88\",\"DATA\":{\"logic\":\"Equal\",\"value\":188}}]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => $_REQUEST["sort"],
        "ELEMENT_SORT_FIELD2" => "sort",
        "ELEMENT_SORT_ORDER" => $_REQUEST["method"],
        "ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
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
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                </div>
            </div>
        </div>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
