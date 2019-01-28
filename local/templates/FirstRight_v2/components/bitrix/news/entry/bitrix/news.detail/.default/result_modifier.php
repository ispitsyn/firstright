<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(isset($arResult['TAGS'])) {
    $arTags = explode(',', $arResult['TAGS']);
    foreach ($arTags as &$arTag) {
        $arTag = trim($arTag);
    }
    $arResult['TAGS'] = $arTags;
}

$titles = array('просмотр', 'просмотра', 'просмотров');
function declOfNum($number, $titles)
{
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number." ".$titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
}
$arResult['SHOW_TEXT'] = declOfNum($arResult['SHOW_COUNTER'] ? $arResult['SHOW_COUNTER'] : 0,$titles);