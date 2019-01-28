<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section">
    <div class="social-section__box section__box">
        <?if(!empty($arParams['TITLE'])){?>
        <div class="social-section__header section__header">
            <div class="social-section__title section__title"><?=$arParams['TITLE']?></div>
        </div>
        <?}?>
        <div class="social-section__list">
            <a href="https://vk.com/firstrightru" class="social-section__item social-section__item_vk">
                <div class="social-section__item-icon">
                    <svg class="svg-icon">
                        <use xlink:href="#social_vk"></use>
                    </svg>
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">ВКонтакте</div>
                    <div class="social-section__item-quantity"><?$APPLICATION->AddBufferContent("number_subscribers_vk");?> подписчиков</div>
                </div>
            </a>
            <a href="https://www.instagram.com/firstrightru/" class="social-section__item social-section__item_in">
                <div class="social-section__item-icon">
                    <svg class="svg-icon">
                        <use xlink:href="#social_in"></use>
                    </svg>
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Instagram</div>
                    <div class="social-section__item-quantity"><?$APPLICATION->AddBufferContent("number_subscribers_in");?> подписчиков</div>
                </div>
            </a>
            <a href="https://fb.me/firstrightru" class="social-section__item social-section__item_fb">
                <div class="social-section__item-icon">
                    <svg class="svg-icon">
                        <use xlink:href="#social_fb"></use>
                    </svg>
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Facebook</div>
                    <div class="social-section__item-quantity"><?$APPLICATION->AddBufferContent("number_subscribers_fb");?> подписчиков</div>
                </div>
            </a>
            <a href="https://t.me/firstrightru" class="social-section__item social-section__item_tel">
                <div class="social-section__item-icon">
                    <svg class="svg-icon">
                        <use xlink:href="#social_tel"></use>
                    </svg>
                </div>
                <div class="social-section__item-info">
                    <div class="social-section__item-name">Telegram</div>
                    <div class="social-section__item-quantity">679 подписчиков</div>
                </div>
            </a>
        </div>
        <div class="section__footer"></div>
    </div>
</div>
