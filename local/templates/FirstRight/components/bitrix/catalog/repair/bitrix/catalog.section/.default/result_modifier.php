<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */


$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


foreach ($arResult['ITEMS'] as $item) {
    $current_repair_code = $item['PROPERTIES']['REPAIR_TYPE']['VALUE_XML_ID'];
    $REPAIR[$current_repair_code]['ITEMS'][] = $item;
}

foreach ($REPAIR as &$category) {
    $category['NAME'] = $category['ITEMS'][0]['PROPERTIES']['REPAIR_TYPE']['VALUE'];
    foreach ($category['ITEMS'] as $item) {
        $category['GROUPS'][$item['PROPERTIES']['GROUP']['VALUE']][] = $item;
    }
    unset($category['ITEMS']);
}

$arResult['REPAIR'] = $REPAIR;