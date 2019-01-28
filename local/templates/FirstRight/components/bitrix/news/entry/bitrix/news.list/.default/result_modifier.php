<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['PREVIEW_PICTURE']['SRC'] = $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, false)['src'];
}