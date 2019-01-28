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
<?if (!empty($arElements) && is_array($arElements)) {?>

<?$custom_sort = 'N';
if(!empty($_REQUEST["sort"]))
{
    $custom_sort = 'Y';
    if ($_REQUEST["sort"] == "name" ||
        $_REQUEST["sort"] == "show_counter" ||
        $_REQUEST["sort"] == "property_price")
    {
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
if($custom_sort === 'N') $arSort[1]['ACTIVE'] = 'Y'; ?>
    <section class="sort sort_product">
        <div class="sort__box section">
            <ul class="sort__list">
                <?
                $currentGet = $_GET;
                if(isset($currentGet['sort']) && isset($currentGet['method'])) {
                    if(isset($currentGet['sort'])) unset($currentGet['sort']);
                    if(isset($currentGet['method'])) unset($currentGet['method']);
                }
                $currentGet = '?'.http_build_query($currentGet, '', '&');
                foreach ($arSort as $itemSort):
                    $current_active = $itemSort['TYPE'] === $_REQUEST['sort'] &&
                    $itemSort['DIR'] === $_REQUEST['method'] ||
                    $itemSort['ACTIVE'] === 'Y' ? ' active' :  '';
                    ?>
                    <li class="sort__item"><a class="sort__link btn btn_sort<?=$current_active;?>" href="<?=$APPLICATION->GetCurPage().$currentGet.'&sort='.$itemSort['TYPE'].'&method='.$itemSort['DIR'];?>"><span class="sort__item-text"><?=$itemSort['NAME']?></span></a></li>
                <?endforeach;?>
            </ul>
        </div>
    </section>
    <section class="catalog">
        <div class="catalog__box section">
            <div class="catalog__filter">
                <section class="catalog-filter bx-filter">
                    <?if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '') $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
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
                    }?>
                    <? if ($isFilter): ?>
                        <?$APPLICATION->IncludeComponent(
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
                                "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                    <? endif ?>
                </section>
            </div>
            <div class="catalog__grid-cards">
                <?  global $searchFilter;
                $searchFilter = array(
                    "=ID" => $arElements,
                );
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "product",
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
        </div>
    </section>
<?} elseif (is_array($arElements)) {
	echo GetMessage("CT_BCSE_NOT_FOUND");
}?>