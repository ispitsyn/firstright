<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$QUANTITY_SELECT = 0;
foreach($arResult as $arItem) {
    if($arItem['SELECTED']) $QUANTITY_SELECT++;
}
$arParams['QUANTITY_SELECT'] = $QUANTITY_SELECT;