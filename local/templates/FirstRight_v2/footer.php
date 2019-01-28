<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
</div>
<footer class="footer">
    <div class="footer__top section">
        <div class="footer__box section__box">
            <div class="subscribe subscribe_footer">
                <p class="subscribe__text">Подпишись на рассылку и узнавай<br> первым о всех акциях и скидках</p>
                <div class="subscribe__form">
                    <div class="vue-component" data-component="FooterSubscribe"></div>
                    <?if(false){?>
                    <div class="field-group field-group_subscribe"><input class="field" type="mail" name="email" placeholder="Введите ваш e-mail"/>
                        <div class="button button_theme_footer-subscribe">
                            <span class="button__text">Подписаться</span>
                        </div>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__main section">
        <div class="footer__box section__box">
            <div class="footer__section">
                <div class="footer__logo">
                    <?if($APPLICATION->GetCurPage() !== '/'):?><a href="/"><?endif;?>
                        <svg class="svg-icon">
                            <use xlink:href="#logo_footer"></use>
                        </svg>
                    <?if($APPLICATION->GetCurPage() !== '/'):?></a><?endif;?>
                </div>
                <p class="footer__politic">Сайт носит сугубо информационный<br/>характер и не является публичной офертой,<br/>определяемой Статьей 437 (2) ГК РФ.</p>
            </div>
            <div class="footer__section">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer_1",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer"
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__section">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer_2",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer"
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__section">
                <div class="footer__contacts">
                    <a class="footer__tel" href="tel:84998008080">8 (499) 800-80-80</a>
                    <a class="footer__tel" href="tel:89063528062">8 (906) 352-80-62</a>
                    <p class="footer__work-time">Режим работы интернет магазина<br/>круглосуточно с 08:00 до 22:00</p>
                </div>
                <div class="social">
                    <ul class="social__list">
                        <li class="social__item social__item_vk">
                            <a class="social__item-link" href="#">
                                <svg class="svg-icon"><use xlink:href="#social_vk"></use></svg>
                                <span class="social__item-name">ВКонтакте</span>
                            </a>
                        </li>
                        <li class="social__item social__item_in">
                            <a class="social__item-link" href="#">
                                <svg class="svg-icon"><use xlink:href="#social_in"></use></svg>
                                <span class="social__item-name">Instagram</span>
                            </a>
                        </li>
                        <li class="social__item social__item_fb">
                            <a class="social__item-link" href="#">
                                <svg class="svg-icon"><use xlink:href="#social_fb"></use></svg>
                                <span class="social__item-name">Facebook</span>
                            </a>
                        </li>
                        <li class="social__item social__item_tel"><a class="social__item-link" href="#">
                                <svg class="svg-icon"><use xlink:href="#social_tel"></use></svg>
                                <span class="social__item-name">Telegram</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom section">
        <div class="footer__box section__box">
            <div class="footer__section">
                <p>&copy; 2016 - <?= date('Y') ?> First Right. Все права защищены.</p>
            </div>
            <div class="footer__section"><a href="#">Политика конфиденциальности</a></div>
            <div class="footer__section"><a href="#">Мобильная версия сайта</a></div>
            <div class="footer__section"><a href="#">Карта сайта</a></div>
        </div>
    </div>
</footer>
</div>
<script src="<?= $assetManager->getEntry('main.js') ?>"></script>
<? use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/lib.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");?>
<? $APPLICATION->IncludeFile(
    SITE_DIR . "/include/svg/icons.php",
    Array(),
    Array(
        "NAME" => "SVG_ICONS",
        "MODE" => "php")
); ?>
</body>
</html>
