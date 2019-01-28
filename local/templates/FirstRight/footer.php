<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?if($APPLICATION->GetCurPage() !== '/'){?>
<?$APPLICATION->AddBufferContent("contentFooter");?>
<?};?>
</div>
<footer class="footer">
    <div class="social-section">
        <div class="social-section__list section">
            <div class="social-section__item">
                <div class="social-section__item-icon social-section__item-icon_vk">
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Vkontakte</div>
                    <div class="social-section__item-quantity">1215+ подписчиков</div>
                </div>
            </div>
            <div class="social-section__item">
                <div class="social-section__item-icon social-section__item-icon_fb">
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Facebook</div>
                    <div class="social-section__item-quantity">635+ подписчиков</div>
                </div>
            </div>
            <div class="social-section__item">
                <div class="social-section__item-icon social-section__item-icon_in">
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Instagram</div>
                    <div class="social-section__item-quantity">2830+ подписчиков</div>
                </div>
            </div>
            <div class="social-section__item">
                <div class="social-section__item-icon social-section__item-icon_tel">
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Telegram</div>
                    <div class="social-section__item-quantity">675+ подписчиков</div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__box section">
        <div class="footer__logo"><img class="footer__logo-img" src="<?=SITE_TEMPLATE_PATH?>/images/icon/logo_footer.png" alt="" role="presentation"/>
            <p class="footer__politic">Сайт носит сугубо информационный характер и<br/>не является публичной офертой,<br/>определяемой Статьей 437 (2) ГК РФ.
            </p>
        </div>
        <div class="footer__navigation">
            <section class="footer-navigation">
                <nav class="footer-navigation__box">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "footer_1",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "footer"
                        ),
                        false
                    );?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "footer_2",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "footer"
                        ),
                        false
                    );?>
                </nav>
            </section>
        </div>
        <div class="footer__contacts"><a class="footer__tel" href="tel:84998008080">8 (499) 800-80-80</a><a class="footer__tel" href="tel:89063528062">8 (906) 352-80-62</a>
            <p class="footer__work-time">Режим работы интернет магазина<br/>круглосуточно с 10:00 до 22:00</p>
        </div>
    </div>
    <div class="footer__copyright">
        <div class="footer__copyright-box section">
            <p class="footer__copyright-text">&copy; 2016 - <?=date('Y')?> First Right. Все права защищены.
            </p><a class="footer__confidential" href="/data-safety/">Политика конфиденциальности</a>
        </div>
    </div>
</footer>
<?$APPLICATION->IncludeFile(
    SITE_DIR . "/include/general/order-popup.php",
    Array(),
    Array(
        "NAME" => "ORDER_POPUP",
        "MODE" => "php")
);?>
</div>
<?$APPLICATION->IncludeFile(
    SITE_DIR . "/include/svg/icons.php",
    Array(),
    Array(
    "NAME" => "SVG_ICONS",
    "MODE" => "php")
);?>
</body>
</html>
