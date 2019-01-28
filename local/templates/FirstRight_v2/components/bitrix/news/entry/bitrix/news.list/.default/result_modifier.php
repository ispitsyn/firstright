<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$titles = array('просмотр', 'просмотра', 'просмотров');
function declOfNum($number, $titles) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number." ".$titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
}

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['SHOW_TEXT'] = declOfNum($arItem['SHOW_COUNTER'] ? $arItem['SHOW_COUNTER'] : 0,$titles);
    $arItem['PREVIEW_PICTURE']['SRC'] = $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, false)['src'];
}

