<?php
use Bitrix\Main\IO,
    Bitrix\Main\Application;
// composer autoload и dotenv подключаются в файлах конфигурации ядра
// bitrix/.settings.php и bitrix/php_interface/dbconn.php
// которые в свою очередь можно обновить, отредактировав данные в директории /environments/
// и "перезагрузить" командой `./vendor/bin/jedi env:init default`



// так как  автолоад (в нашем случае) регистрируется до ядра,
// Твиг не успевает зарегистрироваться
// необходимо это действие повтроить еще раз:

maximasterRegisterTwigTemplateEngine();

Arrilot\BitrixModels\ServiceProvider::register();
Arrilot\BitrixModels\ServiceProvider::registerEloquent();

Bex\Monolog\MonologAdapter::loadConfiguration();

//include_once 'events.php';

function headline() {
    global $APPLICATION;
    $isShow = true;
    $isHeadlineBox = true;

    $pageType = $APPLICATION->GetProperty('page_type');

    $title = $APPLICATION->GetPageProperty('header_title');
    if(!strlen($title)) $title = $APPLICATION->GetTitle(false);

    $description = '';
    $headerDescriptionPage = $APPLICATION->GetPageProperty('header_description');
    $headerDescriptionDir = $APPLICATION->GetDirProperty('header_description');
    if(strlen($headerDescriptionPage) || strlen($headerDescriptionDir)) {
        $description = strlen($headerDescriptionPage) ? $headerDescriptionPage : $headerDescriptionDir;
    }

    $cover = false;
    if(!empty($GLOBALS['PAGE_COVER'])) {
        $pathCover = Application::getDocumentRoot() . $GLOBALS['PAGE_COVER'];
        $coverFile = new IO\File($pathCover);
        if($coverFile->isExists()) {
            $cover = $GLOBALS['PAGE_COVER'];
        } else {
            $cover = false;
        }
    }
    if(!$cover) {
        $cover = $APPLICATION->GetPageProperty('cover');
        if(strlen($cover)) {
            $pathCover = Application::getDocumentRoot() . SITE_TEMPLATE_PATH . '/images/covers/' . $cover;
            $coverFile = new IO\File($pathCover);
            if($coverFile->isExists()) {
                $cover = SITE_TEMPLATE_PATH . '/images/covers/' . $cover;
            } else {
                $cover = false;
            }
        }
    }

    if($pageType==='search') $isHeadlineBox = false;
    if($pageType==='entry') $isHeadlineBox = false;
    if($pageType==='product') $isHeadlineBox = false;
    if($APPLICATION->GetCurPage() === '/') $isShow = false;

    if($isShow) {
        ob_start(); ?>
        <section class="headline headline_theme_<?=$pageType?>">
            <div class="headline__breadcrumbs">
                <?= $APPLICATION->GetNavChain(false, false, false, true) ?>
            </div>
            <?if($isHeadlineBox){?>
                <div class="headline__box<?=$cover ? ' headline__box_background" style="background-image: url('.$cover.');"' : '"'?>>
                    <h1 class="headline__title"><?=$title;?></h1>
                    <?if(strlen($description)){?>
                        <h2 class="headline__description"><?=$description;?></h2>
                    <?}?>
                </div>
            <?}?>
        </section>
        <? $content = ob_get_contents();
        ob_end_clean();
        return $content;
    } else {
        return '';
    }
}


/*function number_subscribers_vk() {
    $json_string = file_get_contents('https://api.vk.com/method/groups.getById?group_id=59696147&fields=members_count&access_token=0d8cf91449f1747b332fdbcd927c5b64d0e377c3e28ebfceb76fa1996d2a6e8e9fc2e28a52ce15bd3b115&v=5.9');
    $json = json_decode($json_string, true);
    return $json['response'][0]['members_count'];
}
function number_subscribers_in() {
    $json_string = file_get_contents('https://api.instagram.com/v1/users/self/?access_token=3675283831.a2d654d.827e704e20a7401d8f9d1fd32a697ffe');
    $json = json_decode($json_string, true);
    return $json['data']['counts']['followed_by'];
}
function number_subscribers_fb() {
    $json_string = file_get_contents('https://graph.facebook.com/v3.2/page-id/?fields=fan_count&id=842560192751978&access_token=EAAEhz5LU0moBAFUfz7Gs5Am3nXS8NUnrvF7w6eLi54ZCJQJwmHwerDkNIDXFFsN3eEK7xBE0IpjqSYLpSvujIIpFAbKT6jCZCdfpI876h57a60yykNCNX0Nt3B96CFZB5iqZBWZAJk9MfwMAgUULLZCSMGkkse2cLrkGQ5e0hOpuFfBaaZA4jWJmnCXCPehnZCYsHMuaNSY4ZCQZDZD');
    $json = json_decode($json_string, true);
    return $json['fan_count'];
}*/

