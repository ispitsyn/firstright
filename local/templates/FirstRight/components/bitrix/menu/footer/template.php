<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <ul class="footer-navigation__list">
        <?foreach($arResult as $arItem){?>
            <?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
            <?if($arItem["SELECTED"]):?>
                <li class="footer-navigation__item"><span class="footer-navigation__link footer-navigation__link_active"><?=$arItem["TEXT"]?></span></li>
            <?else:?>
                <li class="footer-navigation__item"><a class="footer-navigation__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?}?>
    </ul>
<?endif?>
