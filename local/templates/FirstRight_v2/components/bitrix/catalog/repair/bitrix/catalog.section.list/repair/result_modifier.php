<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$current_dir_path = $APPLICATION->GetCurDir();
foreach ($arResult['SECTIONS'] as &$section) {
    $section['SECTION_PAGE_URL'] === $current_dir_path ? $section['SELECT'] = true : $section['SELECT']= false;
}