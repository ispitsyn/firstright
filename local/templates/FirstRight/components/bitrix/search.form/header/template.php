<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<div class="header-search" data-search="">
    <div class="header-search__box">
        <div class="header-search__close" onclick=""></div>
        <form class="header-search__aria" action="<?=$arResult["FORM_ACTION"]?>">
            <div class="header-search__btn" onclick="">
            </div><?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
                    "bitrix:search.suggest.input",
                    "",
                    array(
                        "NAME" => "q",
                        "VALUE" => "",
                        "INPUT_SIZE" => 15,
                        "DROPDOWN_SIZE" => 10,
                    ),
                    $component, array("HIDE_ICONS" => "Y")
                );?>
            <?else:?><input class="header-search__field" placeholder="Поиск по сайту" type="text" name="q" value="" maxlength="50" /><?endif;?>
        </form>
    </div>
    <div class="header-search__cover"></div>
</div>
