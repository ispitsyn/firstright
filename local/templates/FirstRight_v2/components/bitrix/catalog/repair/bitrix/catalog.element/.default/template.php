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

$currentPrice = $arResult['PROPERTIES']['PRICE']['~VALUE'];
if(!strlen(trim($currentPrice))) {
    $currentPrice = 'уточняйте';
} else if(!intval($currentPrice)) {
    $currentPrice = 'бесплатно';
} else {
    $currentPrice = $currentPrice.' р';
}

$currentTime = $arResult['PROPERTIES']['TIME']['VALUE'];
if(strlen(trim($currentTime))) {
    if(intval($currentTime)/60 > 1) {
        $thisTime = '';
        $thisTime = floor($currentTime/60).' час';
        if($currentTime%60) $thisTime .= ' '.($currentTime%60).' мин';
        $currentTime = $thisTime;
    } else {
        $currentTime = $currentTime.' мин';
    }
}

?>
<div class="repair-detail">
    <div class="repair-detail__box section">
        <div class="repair-detail__view">
            <img class="repair-detail__image" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" role="presentation"/>
        </div>
        <div class="repair-detail__info">
            <div class="repair-detail__offer">
                <div class="repair-detail__offer-col repair-detail__offer-col_price"><?=$currentPrice?></div>
                <div class="repair-detail__offer-col repair-detail__offer-col_order">
                    <div class="button button_theme_repair-detail">
                        <span class="button__text">Оформить заказ</span>
                    </div>
                </div>
                <div class="repair-detail__offer-col repair-detail__offer-col_time"><?=$currentTime?></div>
            </div>
        </div>
    </div>
</div>
<div class="content-box">
    <div class="content-box__box section">
        <?=$arResult['DETAIL_TEXT'];?>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/general/advantages_part-1.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/general/callback-banner.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "",
        "THEME" => "white"
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/general/advantages_part-2.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
