<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <nav class="content-nav">
        <ul class="content-nav__list">
            <?foreach($arResult as $arItem){?>
                <?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
                <?if($arItem["SELECTED"]):?>
                    <li class="content-nav__item"><span class="content-nav__link content-nav__link_active"><?=$arItem["TEXT"]?></span></li>
                <?else:?>
                    <li class="content-nav__item"><a class="content-nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>
            <?}?>
        </ul>
    </nav>
<?endif?>
