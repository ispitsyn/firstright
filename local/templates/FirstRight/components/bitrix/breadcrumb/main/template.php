<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult)) return "";

$strReturn .= '<nav class="breadcrumbs"><ol class="breadcrumbs__list" itemscope="" itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);

for($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

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
            <li class="breadcrumbs__item breadcrumbs__item_active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <span class="breadcrumbs__link" itemprop="item">
                    <strong class="breadcrumbs__text" itemprop="name">'.$title.'</strong>
                </span>
                <meta itemprop="position" content="'.($index+1).'"/>
            </li>';
	}
}

$strReturn .= '</ol></nav>';

return $strReturn;?>


<nav class="breadcrumbs">
    <ol class="breadcrumbs__list" itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a class="breadcrumbs__link" href="javascript:void(0)" itemprop="item">
                <span class="breadcrumbs__text" itemprop="name">Главная</span>
            </a>
            <meta itemprop="position" content="1"/>
        </li>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="breadcrumbs__link" href="javascript:void(0)" itemprop="item"><span class="breadcrumbs__text" itemprop="name">Apple</span></a>
            <meta itemprop="position" content="2"/>
        </li>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="breadcrumbs__link" href="javascript:void(0)" itemprop="item"><span class="breadcrumbs__text" itemprop="name">Mac</span></a>
            <meta itemprop="position" content="3"/>
        </li>
        <li class="breadcrumbs__item active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span class="breadcrumbs__link" itemprop="item">
                <strong class="breadcrumbs__text" itemprop="name">MacBook Pro</strong>
            </span>
            <meta itemprop="position" content="4"/>
        </li>
    </ol>
</nav>