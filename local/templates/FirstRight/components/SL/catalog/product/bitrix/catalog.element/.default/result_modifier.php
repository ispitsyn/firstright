<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

\Bitrix\Main\Loader::includeModule('highloadblock');
$GALLERY = array('ORIGINAL'=>array(),'MIN'=>array());
if(!empty($arResult['PROPERTIES']['GALLERY']['VALUE']) && count($arResult['PROPERTIES']['GALLERY']['VALUE']) > 0) {
    foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $image) {
        $GALLERY['ORIGINAL'][] = CFile::GetPath($image);
        $GALLERY['MIN'][] = CFile::ResizeImageGet($image, array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
}
$arResult['GALLERY'] = $GALLERY;

if(!empty($arResult['PROPERTIES']['IMAGES']['VALUE'])) {
    $arImages = array();
    $arMinImages = array();
    foreach ($arResult['PROPERTIES']['IMAGES']['VALUE'] as $currentImage){
        $arImages[] = CFile::GetPath($currentImage);
        $arMinImages[] = CFile::ResizeImageGet($currentImage, Array("width" => 100, "height" => 100), BX_RESIZE_IMAGE, false)['src'];
    }
    $arResult['IMAGES'] = $arImages;
    $arResult['MIN_IMAGES'] = $arMinImages;
}

if(!empty($arResult['PROPERTIES']['PRODUCT_CONNECT']['VALUE_XML_ID']) && !empty($arResult['PROPERTIES']['UNIQUE']['VALUE'])) {

    $uniqueProperties = [];
    foreach ($arResult['PROPERTIES']['UNIQUE']['VALUE'] as $key => $PROPERTY) {
        $unique_name = $arResult['PROPERTIES']['UNIQUE']['VALUE_XML_ID'][$key];
        $unique_value = $arResult['PROPERTIES'][$unique_name]['~VALUE'];

        $uniqueProperties['PROPERTY_'.$unique_name.'_VALUE'] = $unique_value;
    }
    unset($key);
    unset($PROPERTY);

    if(!empty($uniqueProperties)) {
        $PRODUCT_CONNECT = $arResult['PROPERTIES']['PRODUCT_CONNECT'];
        $arConnectProperties = [];
        $firstPropertyName = false;
        foreach ($PRODUCT_CONNECT['VALUE_XML_ID'] as $PROPERTY) {
            if(empty($arResult['PROPERTIES'][$PROPERTY]['VALUE'])) continue;

            if(!$firstPropertyName) $firstPropertyName = $PROPERTY;
            $arConnectProperties[$PROPERTY] = $arResult['PROPERTIES'][$PROPERTY]['VALUE'];
        }

        $arFilter   = [
            "IBLOCK_ID" => $arResult['IBLOCK_ID'],
            "IBLOCK_SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
        ];
        $arFilter += $uniqueProperties;
        $arSelect   = ['IBLOCK_ID','ID','NAME','DETAIL_PAGE_URL'];
        foreach ($arConnectProperties as $keyProperty => $arProperty) {
            $arSelect[] = 'PROPERTY_'.$keyProperty;
        }
        $Links = [];
        $resultFilter = [];
        $arOtherElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while ($currentElement = $arOtherElements->GetNext()) {
            $resultFilter[] = $currentElement;
            $isFirstProperty = true;
            $isFirstPropertyTrue = false;
            $isPrevPropertyLevel = true;
            foreach ($arConnectProperties as $keyProperty => $valueProperty) {
                if($isFirstProperty) {
                    if($currentElement['PROPERTY_'.$keyProperty.'_VALUE'] === $valueProperty)  {
                        $isFirstPropertyTrue = true;
                    } else {
                        $isFirstPropertyTrue = false;
                    }
                } else {
                    if($isPrevPropertyLevel && $isFirstPropertyTrue) {
                        $Links[$keyProperty][$currentElement['PROPERTY_'.$keyProperty.'_VALUE']] = [
                            'value' => $currentElement['PROPERTY_'.$keyProperty.'_VALUE'],
                            'value_id' => $currentElement['PROPERTY_'.$keyProperty.'_VALUE_ID'],
                            'link' => $currentElement['DETAIL_PAGE_URL'],
                            'current' => $currentElement['ID'] == $arResult['ID']
                        ];
                    }
                    if($currentElement['PROPERTY_'.$keyProperty.'_VALUE'] !== $valueProperty) $isPrevPropertyLevel = false;
                }
                if( end($arConnectProperties) === $valueProperty && // если последнее св-во.
                    $isPrevPropertyLevel && // если до посл. св-ва было ок
                    ($isFirstProperty ||
                        ($currentElement['PROPERTY_'.$keyProperty.'_VALUE'] === $valueProperty && !$isFirstProperty)
                    )
                ) { // если посл. св-во ок
                    $Links[$firstPropertyName][$currentElement['PROPERTY_'.$firstPropertyName.'_VALUE']] = [
                        'value' => $currentElement['PROPERTY_'.$firstPropertyName.'_VALUE'],
                        'value_id' => $currentElement['PROPERTY_'.$firstPropertyName.'_VALUE_ID'],
                        'link' => $currentElement['DETAIL_PAGE_URL'],
                        'current' => $currentElement['ID'] == $arResult['ID']
                    ];
                }
                $isFirstProperty = false;
            }
        }
        foreach ($Links as $arKeyLinks => $arLinks) {
            if($arKeyLinks === 'COLOR') {

                $codeColors = [];
                foreach ($Links[$arKeyLinks] as $link) {
                    $codeColors[] = $link['value'];
                }
                array_unique($codeColors);

                if(count($codeColors)) {
                    if (\Bitrix\Main\Loader::includeModule('highloadblock'))
                    {
                        $ID = 1;
                        $hldata = HLBT::getById($ID)->fetch();
                        $hlentity = HLBT::compileEntity($hldata);
                        $hlDataClass = $hldata['NAME'] . 'Table';
                        $result = $hlDataClass::getList(array(
                            'select' => array('ID', 'UF_NAME', 'UF_FILE', 'UF_XML_ID','UF_SORT'),
                            'order' => array('UF_SORT' => 'ASC'),
                            'filter' => array('UF_XML_ID' => $codeColors)
                        ));
                        while ($res = $result->fetch())
                        {
                            $Links[$arKeyLinks][$res['UF_XML_ID']]['value'] = $res['UF_NAME'];
                            $Links[$arKeyLinks][$res['UF_XML_ID']]['src'] = CFile::GetPath($res['UF_FILE']);
                        }
                    }
                }
            } else {

                $property_enums = CIBlockPropertyEnum::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>$arResult["IBLOCK_ID"], "CODE"=>$arKeyLinks]);
                $arPropertyValue = [];
                while($enum_fields = $property_enums->GetNext())
                {
                    if(isset($Links[$arKeyLinks][$enum_fields['VALUE']])) {
                        $arPropertyValue[] = $Links[$arKeyLinks][$enum_fields['VALUE']];
                    }
                }
                $Links[$arKeyLinks] = $arPropertyValue;
            }
        }

        $Links_sort = [];
        foreach ($Links as $key => $PROPERTY) {
            if(empty($arResult['PROPERTIES'][$key]['VALUE'])) continue;
            $Links_sort[$arResult['PROPERTIES'][$key]['SORT']] = [
                'name' => $arResult['PROPERTIES'][$key]['NAME'],
                'code' => strtolower(str_replace('_','-', $arResult['PROPERTIES'][$key]['CODE'])),
                'items' => $PROPERTY
            ];
        }
        ksort($Links_sort);

        $arResult['PRODUCT_OPTIONS'] = $Links_sort;
    }
}

if (!empty($arResult['PROPERTIES']['OFFERS']['VALUE']))
{
    $IBLOCK_ID = $arResult['PROPERTIES']['OFFERS']['LINK_IBLOCK_ID'];
    $arSet = array();
    $setItems = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $arResult['PROPERTIES']['OFFERS']['VALUE']), false, false, array('ID', "NAME", "DETAIL_TEXT", "PROPERTY_PRICE"));
    while ($currentItem = $setItems->GetNext())
    {
        $itemSet['NAME'] = $currentItem['NAME'];
        $itemSet['PRICE'] = number_format($currentItem['PROPERTY_PRICE_VALUE'], 0, ',', ' ');
        $itemSet['TEXT'] = htmlspecialcharsBack(trim($currentItem['DETAIL_TEXT']));
        $arSet[] = $itemSet;
    }
    $arResult['SET'] = $arSet;
}
