<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="callback-banner <?if(strlen($arParams['THEME'])){?>callback-banner_theme_<?=$arParams['THEME'];?><?}?>">
    <div class="callback-banner__box section">
        <p class="callback-banner__title">Нужна помощь или консультация по телефону?
        </p>
        <p class="callback-banner__description">Оставте быструю заявку и ждите звонка от наших специалистов!
        </p>
        <div class="callback-banner__btn">
            <div class="btn btn_repair-category waves-effect" @click="dialogTableVisible = true"><span>Оставить заявку</span></div>
        </div>
    </div>
</div>
