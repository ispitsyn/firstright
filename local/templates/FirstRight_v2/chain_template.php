<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return "";
$strReturn = '';
$strReturn .= '<nav class="breadcrumbs section"><ol class="breadcrumbs__list section__box" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
    {
        $strReturn .= '
            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" itemprop="item">
                    <span class="breadcrumbs__text" itemprop="name">'.$title.'</span>
                </a>
                <meta itemprop="position" content="'.($index+1).'"/>
            </li>';
    }
    else
    {
        $strReturn .= '
            <li class="breadcrumbs__item breadcrumbs__item active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <span class="breadcrumbs__link" itemprop="item">
                    <strong class="breadcrumbs__text" itemprop="name">'.$title.'</strong>
                </span>
                <meta itemprop="position" content="'.($index+1).'"/>
            </li>';
    }
}
$strReturn .= '</ol></nav>';
return $strReturn;
