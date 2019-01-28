<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="ru">
    <head>
        <meta name="viewport" content="width=1280">
        <?if(false):?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
        <?endif;?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="imagetoolbar" content="no">
        <meta name="msthemecompatible" content="no">
        <meta name="cleartype" content="on">
        <meta name="HandheldFriendly" content="True">
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="address=no">
        <meta name="google" value="notranslate">
        <meta name="theme-color" content="#ffffff">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon-180x180.png" />

        <?$rsSites = CSite::GetByID("s1"); $arSite = $rsSites->Fetch();?>
        <title><?$APPLICATION->ShowTitle()?><?= $APPLICATION->GetCurPage() !=='/' ? ' - ' . $arSite['NAME'] : '';?></title>
        <meta property="og:title" content="<?$APPLICATION->ShowTitle()?><?= $APPLICATION->GetCurPage() !=='/' ? ' - ' . $arSite['NAME'] : '';?>" />
        <meta property="og:site_name" content="https://brandshop.ru/">
        <meta property="og:image" content="<?$APPLICATION->AddBufferContent("getOgImage");?>">
        <meta name="description" content="Quick Way. Быстрый сервис, качественный ремонт, большой ассортимент устройств Appple и аксессуаров.">
        <meta property="og:description" content="Quick Way. Быстрый сервис, качественный ремонт, большой ассортимент устройств Appple и аксессуаров.">
        <meta name="keywords" content="">
        <link href="https://unpkg.com/flickity@2/dist/flickity.min.css" rel="stylesheet">
        <style>@-webkit-keyframes nprogress-spinner{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(360deg)}}@keyframes nprogress-spinner{0%{transform:rotate(0deg)}to{transform:rotate(360deg)}}#nprogress{pointer-events:none}#nprogress .bar{background:#ff5722;position:fixed;z-index:1031;top:0;left:0;width:100%;height:2px}#nprogress .peg{display:block;position:absolute;right:0;width:100px;height:100%;box-shadow:0 0 10px #ff5722,0 0 5px #ff5722;opacity:1;-webkit-transform:rotate(3deg) translate(0,-4px);-ms-transform:rotate(3deg) translate(0,-4px);transform:rotate(3deg) translate(0,-4px)}#nprogress .spinner{display:block;position:fixed;z-index:1031;top:15px;right:15px}#nprogress .spinner-icon{width:18px;height:18px;box-sizing:border-box;border:solid 2px transparent;border-top-color:#ff5722;border-left-color:#ff5722;border-radius:50%;-webkit-animation:nprogress-spinner 400ms linear infinite;animation:nprogress-spinner 400ms linear infinite}.nprogress-custom-parent{overflow:hidden;position:relative}.nprogress-custom-parent #nprogress .bar,.nprogress-custom-parent #nprogress .spinner{position:absolute}.fade{transition:all 300ms linear 700ms;opacity:1}.fade.out{opacity:0}</style>
        <? use Bitrix\Main\Page\Asset;
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
        Asset::getInstance()->addString("<script>var app = {};</script>");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/nprogress.js");
        Asset::getInstance()->addString("<script>
            document.addEventListener('DOMContentLoaded', function(){
                $('body').show();
                $('.version').text(NProgress.version);
                NProgress.start();
                setTimeout(function() { NProgress.done();
                $('.fade').removeClass('out'); }, 100);
            });
        </script>");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jq.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/lib.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/vue.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/element.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/general.js");
        ?>
        <?$APPLICATION->ShowHead();?>
    </head>
    <body class="page">
    <?if($USER->IsAdmin()):?>
        <div id="panel">
            <?$APPLICATION->ShowPanel();?>
        </div>
    <?endif;?>
    <div class="page__box warp fade out" id="page">
            <header class="header">
                <div class="header-top section">
                    <div class="header-top__contacts">
                        <a class="header-top__tel" href="tel:84998008080">8 (499) 800-80-80</a>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    );?>
                </div>
                <div class="header-main">
                    <div class="header-main__box section">
                        <div class="header-main__box header-main__box_inner">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:search.form",
                                "header",
                                Array(
                                    "PAGE" => "#SITE_DIR#search/index.php",
                                    "USE_SUGGEST" => "N"
                                )
                            );?>
                        </div>
                        <div class="header-main__logo">
                            <?if($APPLICATION->GetCurPage() !== '/'):?><a href="/"><?endif;?>
                            <img class="header-main__logo-img" src="<?=SITE_TEMPLATE_PATH?>/images/icon/logo_fr_2.png" alt="Логотип First Right" role="presentation"/>
                            <?if($APPLICATION->GetCurPage() !== '/'):?></a><?endif;?>
                        </div>
                        <div class="header-main__menu">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => SITE_DIR."/include/general/menu.php",
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "standard.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main">
                <?if($APPLICATION->GetCurPage() !== '/') {?>
                <section class="content-header <?$APPLICATION->AddBufferContent("pageType",'content-header_');?> ">
                    <div class="content-header__breadcrumbs">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "main",
                            Array(
                                "PATH" => "",
                                "SITE_ID" => "s1",
                                "START_FROM" => "0"
                            )
                        );?>
                    </div>
                    <?$APPLICATION->AddBufferContent("pageCover");?>
                </section>
                <?}else{?>
                    <h1 class="h-content"><?$APPLICATION->ShowTitle(false);?></h1>
                <?}?>
                <?$APPLICATION->AddBufferContent("contentHeader");?>