<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("page_type", "main");
$APPLICATION->SetTitle("First Right — Интернет магазин и сервисный центр техники Apple"); ?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/slider.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/offer-group.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/top-product.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/entry-grid.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/new-product.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/category-group.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."/include/index/section_social.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>
