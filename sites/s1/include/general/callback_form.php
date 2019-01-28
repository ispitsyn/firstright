<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="callback-banner <?if(strlen($arParams['THEME'])){?>callback-banner_theme_<?=$arParams['THEME'];?><?}?>">
    <div class="callback-banner__box section">
        <p class="callback-banner__title"><?=$arParams['~TITLE']?></p>
        <p class="callback-banner__description"><?=$arParams['~DESCRIPTION']?></p>
        <div class="callback-banner__btn">
            <div class="btn btn_other-problem waves-effect"><span><?=$arParams['BUTTON_TEXT']?></span></div>
        </div>
    </div>
</div>
