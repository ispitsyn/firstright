<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->AddChainItem("404", "javascript:void(0);");
$APPLICATION->SetTitle("404 Not Found");?>
<h1 style="padding: 45px 0;font-family: 'OpenSans';font-size: 150px;text-align: center">404 - Страница не найдена!</h1>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
