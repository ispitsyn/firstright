<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <nav class="menu" data-search="">
        <ul class="menu__list">
            <?
            $previousLevel = 0;
            $code = '';
            $accessoryNumber = 0;
            $lastCode = '';
            foreach($arResult as $arItem):
            if(($arItem["DEPTH_LEVEL"] == 1)) {
                $code = trim($arItem["LINK"], "|/|");
            }
            ?>

            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                <?if($lastCode === 'accessories') echo '</ul></li>';?>
                <?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>

            <?if ($arItem["IS_PARENT"]):?>
            <?if ($arItem["DEPTH_LEVEL"] == 1 && $arItem["PERMISSION"] > "D"):?>
            <li class="menu__item">
                <?if ($arItem["SELECTED"] &&  $arParams['QUANTITY_SELECT'] == 1){;?>
                    <span class="menu__link menu__link_active"><?=$arItem["TEXT"]?></span>
                <?} else {?>
                    <a class="menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                <?}?>
                <div class="menu__inner-list-box">
                    <ul class="menu__inner-list <?echo strlen($code) ? 'menu__inner-list_'.$code : '';?> section">
                        <?endif?>
                        <?else:?>
                            <?if ($arItem["PERMISSION"] > "D"):?>
                                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                    <li class="menu__item">
                                        <pre style="display: none"><?print_r($arItem)?></pre>
                                        <?if ($arItem["SELECTED"]){?>
                                            <span class="menu__link menu__link_active"><?=$arItem["TEXT"]?></span>
                                        <?} else {?>
                                            <a class="menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                                        <?}?>
                                    </li>
                                <?else:?>
                                    <?switch ($code){
                                        case 'accessories':?>
                                            <?if($accessoryNumber === 0){?>
                                            <li class="menu__inner-item">
                                                <ul class="menu__accessories">
                                            <?}?>
                                            <?if($accessoryNumber === 5){$accessoryNumber = 0;?>
                                                </ul>
                                            </li>
                                            <li class="menu__inner-item">
                                                <ul class="menu__accessories">
                                            <?}?>
                                                    <li class="menu__accessory">
                                                        <?if ($arItem["SELECTED"]){?>
                                                        <span class="menu__accessory-link menu__accessory-link_active"><?=$arItem["TEXT"]?></span>
                                                        <?} else {?>
                                                        <a href="<?=$arItem["LINK"]?>" class="menu__accessory-link"><?=$arItem["TEXT"]?></a>
                                                        <?}?>
                                                    </li>
                                                    <?$accessoryNumber++;?>
                                            <?break;?>
                                        <?default:?>
                                            <li class="menu__inner-item">
                                                <?if ($arItem["SELECTED"]){?>
                                                    <span class="menu__inner-link menu__inner-link_active">
                                                <?} else {?>
                                                    <a class="menu__inner-link" href="<?=$arItem["LINK"]?>">
                                                <?}?>
                                                    <?=htmlspecialcharsBack($arItem['PARAMS']['SECTION_ICON'])?>
                                                    <span class="menu__inner-link-text"><?=$arItem["TEXT"]?><?if(strlen($arItem['PARAMS']['LABEL_TEXT']))echo '<i class="new">'.$arItem['PARAMS']['LABEL_TEXT'].'</i>'?></span>
                                                <?if ($arItem["SELECTED"]){?>
                                                    </span>
                                                <?} else {?>
                                                    </a>
                                                <?}?>
                                            </li>
                                            <?break;?>
                                        <?}?>
                                <?endif?>
                            <?endif?>

                        <?endif?>

                        <?$previousLevel = $arItem["DEPTH_LEVEL"]; $lastCode = $code?>

                        <?endforeach?>

                        <?if ($previousLevel > 1)://close last item tags?>
                            <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                        <?endif?>

                    </ul>
    </nav>
<?endif?>