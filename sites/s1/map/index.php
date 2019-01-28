<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта");
?>Text here....<?$APPLICATION->IncludeComponent(
	"bitrix:sale.ajax.delivery.calculator",
	"",
Array()
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>