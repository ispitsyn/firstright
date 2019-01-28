<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['PREVIEW_PICTURE']['SRC'] = $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, false)['src'];
}
if($arParams['PAGER_SHOW_ALL'] == 'Y') {
    if(CModule::IncludeModule("iblock")) {
        $arIBlock = GetIBlock($arParams['IBLOCK_ID']);
        $arResult['SECTION_PAGE_URL'] = $arIBlock['LIST_PAGE_URL'];
    }
}
