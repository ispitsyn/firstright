<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <nav class="navigation navigation_footer">
        <ul class="navigation__list">
            <?foreach($arResult as $arItem){?>
                <?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
                <?if($arItem["SELECTED"]):?>
                    <li class="navigation__item"><span class="navigation__link navigation__link_active"><?=$arItem["TEXT"]?></span></li>
                <?else:?>
                    <li class="navigation__item"><a href="<?=$arItem["LINK"]?>" class="navigation__link"><?=$arItem["TEXT"]?></a></li>
                <?endif?>
            <?}?>
        </ul>
    </nav>
<?endif?>
