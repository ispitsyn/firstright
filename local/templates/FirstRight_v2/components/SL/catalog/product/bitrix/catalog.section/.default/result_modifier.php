<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\IO,
    Bitrix\Main\Application;
/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

function checkCover($path) {
    $pathCover = Application::getDocumentRoot() . $path;
    $coverFile = new IO\File($pathCover);
    $isExistCover = $coverFile->isExists();
    return $isExistCover;
}
function findCover($params) {
    $pathCover = '';
    $rsSections = CIBlockSection::GetList(
        ["SORT" => "ASC"],
        ["IBLOCK_ID" => $params['IBLOCK_ID'], "ID" => $params['SECTION_ID']],
        false,
        ["IBLOCK_ID","ID","NAME","IBLOCK_SECTION_ID",$params['PROPERTY_NAME']],
        false
    );
    while ($arSection = $rsSections->Fetch()) {
        $path = CFile::GetPath($arSection[$params['PROPERTY_NAME']]);
        if(checkCover($path)) {
            $pathCover = $path;
        } else {
            if($arSection['IBLOCK_SECTION_ID'] != null) {
                $pathCover = findCover([
                    "IBLOCK_ID" => $params['IBLOCK_ID'],
                    "SECTION_ID" => $arSection['IBLOCK_SECTION_ID'],
                    "PROPERTY_NAME" => $params['PROPERTY_NAME']
                ]);
            } else {
                $pathCover = null;
            }
        }
    }
    unset($arSection);
    unset($rsSections);
    return $pathCover;
}

if(!empty($arResult['DETAIL_PICTURE']['SRC']) && checkCover($arResult['DETAIL_PICTURE']['SRC'])) {
    $GLOBALS['PAGE_COVER'] = $arResult['DETAIL_PICTURE']['SRC'];
} else {
    $GLOBALS['PAGE_COVER'] = findCover([
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
        "PROPERTY_NAME" => "DETAIL_PICTURE"
    ]);
}


