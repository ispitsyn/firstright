<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arFilter = array('IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ID' => $arResult['ID']);
$arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'UF_SECTION_TYPE');
$rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
while ($arSection = $rsSections->Fetch())
{
    $GLOBALS['SECTION_TYPE'] =  $arResult['UF_SECTION_TYPE'] = $arSection['UF_SECTION_TYPE'];
}