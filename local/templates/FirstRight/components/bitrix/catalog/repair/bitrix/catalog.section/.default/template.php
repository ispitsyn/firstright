<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);


if (!empty($arResult['NAV_RESULT'])) {
    $navParams = array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$currencyList = '';
if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-' . $navParams['NavNum'];?>
<?if (count($arResult['ITEMS'])) {
$areaIds = []?>
<div class="repair__box section-w">
    <div class="repair__main">
        <div class="repair-tabs repair__tabs">
                <div class="repair-tabs__navigation">
                    <?
                    $first_navigation = true;
                    foreach ($arResult['REPAIR'] as $key => $item_navigation) { ?>
                        <?if($first_navigation){?>
                        <script>
                            document.addEventListener('DOMContentLoaded',function () {
                                app.repairTabShow =  '<?=$key;?>';
                            });
                        </script>
                        <?}?>
                        <div class="repair-tabs__navigation-btn">
                            <div class="btn btn_tab-repair waves-effect"
                                 :class="{active: repairTabShow ==  '<?=$key;?>'}"
                                @click="repairTabShow = '<?=$key;?>'">
                                <span><?= $item_navigation['NAME']; ?></span>
                            </div>
                        </div>
                        <? $first_navigation = false;
                    }
                    unset($first_navigation); ?>
                </div>
                <div class="repair-tabs__tabs">
                    <div class="repair-tabs__tab">
                        <?$first_category = true;
                        foreach ($arResult['REPAIR'] as $key => $item_category) { ?>
                        <ul class="repair__list"  v-show="repairTabShow == '<?=$key;?>'" style="display: none;">
                            <?foreach($item_category['GROUPS'] as $group) {?>
                                <li class="repair__list-box">
                                <?foreach($group as $item) {

                                    $currentPrice = $item['PROPERTIES']['PRICE']['~VALUE'];
                                    if(!strlen(trim($currentPrice))) {
                                        $currentPrice = 'уточняйте';
                                    } else if(!intval($currentPrice)) {
                                        $currentPrice = 'бесплатно';
                                    } else {
                                        $currentPrice = $currentPrice.' р';
                                    }

                                    $currentTime = $item['PROPERTIES']['TIME']['VALUE'];
                                    if(strlen(trim($currentTime))) {
                                        if(intval($currentTime)/60 > 1) {
                                            $thisTime = '';
                                            $thisTime = floor($currentTime/60).' ч';
                                            if($currentTime%60) $thisTime .= ' '.($currentTime%60).' м';
                                            $currentTime = $thisTime;
                                        } else {
                                            $currentTime = $currentTime.' м';
                                        }
                                    }

                                    $current_item = [
                                        'id' => $item['ID'],
                                        'url' => $item['DETAIL_PAGE_URL'],
                                        'name' => $item['NAME'],
                                        'description' => $item['PREVIEW_TEXT'],
                                        'price' => $currentPrice,
                                        'time' => $currentTime,
                                        'gurantee' => strlen($item['PROPERTIES']['GUARANTEE']['VALUE']) ? $item['PROPERTIES']['GUARANTEE']['VALUE'] : 'n\a'
                                    ];

                                    ?>
                                    <div class="repair-item">
                                        <div class="repair-item__box">
                                            <div class="repair-item__info">
                                                <a href="<?=$current_item['url']?>" class="repair-item__title repair-item__title"><span><?=$current_item['name']?></span></a>
                                                <p class="repair-item__description"><?=$current_item['description']?></p>
                                            </div>
                                            <div class="repair-item__time"><?=$current_item['time']?></div>
                                            <div class="repair-item__price"><?=$current_item['price']?></div>
                                            <div class="repair-item__order"
                                                 data-id="<?= $current_item['id']; ?>"
                                                 data-name="<?= $current_item['name']; ?>"
                                                 data-time="<?= $current_item['time']; ?>"
                                                 data-price="<?= $current_item['price']; ?>"
                                                 @click="addServices($event)">Заказать</div>
                                        </div>
                                    </div>
                                <?}?>
                                </li>
                            <?}?>
                        </ul>
                        <?}?>
                    </div>
                </div>
            </div>
    </div>
</div>
    <?$APPLICATION->IncludeFile(
        SITE_DIR . "include/general/callback_other-problem.php",
        Array(),
        Array(
            "NAME" => "",
            "MODE" => "html")
    );?>
    <br>
    <br>
    <? if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') { ?>
            <div class="content-box">
                <div class="content-box__box section">
                    <?=$arResult['DESCRIPTION'];?>
                </div>
            </div>
    <?}?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "TITLE" => "Хотите скидку на ремонт?",
            "DESCRIPTION" => "Оставте быструю заявку на ремонт прямо сейчас <br>и получите скидку в размере 20% на ремонтные работы",
            "BUTTON_TEXT" => "Оставить заявку",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."/include/general/callback_form.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => ""
        ),
        false,
        array('HIDE_ICONS' => 'Y')
    );?>
<?} else {?>
    <? if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') { ?>
        <div class="content-box">
            <div class="content-box__box section">
                <?=$arResult['DESCRIPTION'];?>
            </div>
        </div>
    <?}?>
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
<?}?>
<?if ($showLazyLoad) {?>
    <div class="row bx-<?= $arParams['TEMPLATE_THEME'] ?>">
        <div class="btn btn-default btn-lg center-block" style="margin: 15px;"
             data-use="show-more-<?= $navParams['NavNum'] ?>">
            <?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
        </div>
    </div>
<?}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>