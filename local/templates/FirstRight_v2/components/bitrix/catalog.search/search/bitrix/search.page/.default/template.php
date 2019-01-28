<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<section class="search section">
<form action="" method="get" class="search__box section__box">
    <button type="submit" class="search__btn"></button>
    <?if($arParams["USE_SUGGEST"] === "Y"){
        if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
            $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
            $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
            $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
        }?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:search.suggest.input",
            "",
            array(
                "NAME" => "q",
                "VALUE" => $arResult["REQUEST"]["~QUERY"],
                "INPUT_SIZE" => 40,
                "DROPDOWN_SIZE" => 10,
                "FILTER_MD5" => $arResult["FILTER_MD5"],
            ),
            $component, array("HIDE_ICONS" => "Y")
        );?>
    <?}else{?>
        <input class="search__field" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="Начните поиск" />
    <?};?>
	<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
</form>
<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div>
<?endif;?>
</section>
