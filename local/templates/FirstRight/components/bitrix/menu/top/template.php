<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <nav class="navigation-top">
        <ul class="navigation-top__list">
            <?foreach($arResult as $arItem){?>
                <?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
                <?if($arItem["SELECTED"]):?>
                    <li class="navigation-top__item"><span class="navigation-top__link navigation-top__link_active"><?=$arItem["TEXT"]?></span></li>
                <?else:?>
                    <li class="navigation-top__item"><a class="navigation-top__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>
            <?}?>
        </ul>
    </nav>
<?endif?>
