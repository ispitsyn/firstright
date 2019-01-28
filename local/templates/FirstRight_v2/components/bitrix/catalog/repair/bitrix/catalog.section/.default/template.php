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
$areaIds = [];
?>
    <section class="repair-group section" id="repair-group">
        <div class="repair-group__box section__box">
            <div class="repair-group__header section__header">
                <div class="repair-group__tabs-navigation">
                    <?$first_navigation = true;
                    foreach ($arResult['REPAIR'] as $key => $item_navigation) { ?>
                        <a class="button button_theme_tab-repair <?if($first_navigation){?>active<?}?>" href="tab_<?=$key;?>">
                            <span class="button__text"><?= $item_navigation['NAME']; ?></span>
                        </a>
                        <? $first_navigation = false;
                    }?>
                </div>
            </div>
            <div class="repair-group__tabs">
                <?$first_category = true;
                foreach ($arResult['REPAIR'] as $key => $item_category) {?>
                <div class="repair-group__tab <?if($first_category){?>active<?}?>" id="tab_<?=$key;?>">
                    <?foreach($item_category['GROUPS'] as $group) {?>
                    <div class="repair-group__list">
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
                        <div class="repair-group__item">
                            <div class="repair-card">
                                <div class="repair-card__info">
                                    <a href="<?=$current_item['url']?>" class="repair-card__title"><?=$current_item['name']?></a>
                                    <p class="repair-card__description"><?=$current_item['description']?></p>
                                </div>
                                <div class="repair-card__params">
                                    <p class="repair-card__time"><?=$current_item['time']?></p>
                                    <p class="repair-card__price"><?=$current_item['price']?></p>
                                    <div class="repair-card__order">
                                        <button class="button button_theme_repair-card"
                                              data-id="<?= $current_item['id']; ?>"
                                              data-name="<?= $current_item['name']; ?>"
                                              data-time="<?= $current_item['time']; ?>"
                                              data-price="<?= $current_item['price']; ?>"
                                              @click="addServices($event)">
                                            <span class="button__text">заказать</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?}?>
                    </div>
                    <?}?>
                </div>
                <?$first_category = false;?>
               <?}?>
            </div>
            <div class="callback">
                <div class="callback__box">
                    <div class="callback__header">
                        <div class="callback__title">Не нашли свою неисправность?</div>
                        <div class="callback__description">Если вы не нашли свою неисправность<br>или сомневаетесь в необходимости ремонта,<br>оставте свой номер телефона и мы вам перезвоним!</div>
                    </div>
                    <div class="callback__main">
                        <div class="field-group field-group_callback">
                            <input class="field" type="mail" name="email" placeholder="Введите ваш e-mail">
                            <div class="button button_theme_footer-subscribe">
                                <span class="button__text">Подписаться</span>
                            </div>
                        </div>
                    </div>
                    <div class="callback__footer"></div>
                </div>
            </div>
            <div class="section__footer"></div>
        </div>
    </section>
<?}?>
<section class="advantages section">
    <div class="advantages__box section__box">
        <ul class="advantages__list">
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#map-marker"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Мобильность
                        </p>
                        <p class="advantages-item__description">Наши профессиональные мастера
                            приедутв любую удобную для вас
                            точку Москвы. Домой, в офис, в кафе,
                            в спортивный зал и тд.
                        </p>
                    </div>
                </div>
            </li>
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#diamond"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Качество
                        </p>
                        <p class="advantages-item__description">При ремонте используем
                            профессиональные инструменты
                            и качественные комплектующие для
                            ваших любимых устройств.
                        </p>
                    </div>
                </div>
            </li>
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#warranty"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Гарантия
                        </p>
                        <p class="advantages-item__description">Даем гарантию на все
                            свои услуги, которая подтверждается
                            договором сроком
                            до 1 года.
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<? if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') { ?>
    <section class="section section_grey">
        <div class="section__box">
            <div class="section__header"></div>
            <div class="section__main">
                <div class="content">
                    <?=$arResult['DESCRIPTION'];?>
                </div>
            </div>
            <div class="section__footer"></div>
        </div>
    </section>
<?}?>
<section class="advantages section">
    <div class="advantages__box section__box">
        <ul class="advantages__list">
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#trust"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Доверие
                        </p>
                        <p class="advantages-item__description">По нашей статистике 93% клиентов
                            обращаются повторно и рекомендуют
                            нас своим друзьям и близким
                        </p>
                    </div>
                </div>
            </li>
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#speed"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Скорость
                        </p>
                        <p class="advantages-item__description">70% ремонтов делаются
                            нами менее чем за 40 минут
                        </p>
                    </div>
                </div>
            </li>
            <li class="advantages__item">
                <div class="advantages-item">
                    <div class="advantages-item__view">
                        <svg class="advantages-item__icon svg-icon">
                            <use xlink:href="#buyout"></use>
                        </svg>
                    </div>
                    <div class="advantages-item__info">
                        <p class="advantages-item__title">Выкуп
                        </p>
                        <p class="advantages-item__description">Мы выкупим ваше старое
                            или неисправное устройство,
                            просто позвоните нам
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
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
