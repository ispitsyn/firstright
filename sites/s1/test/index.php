<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Скидки");?><?$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"COL_NUM" => "1",
		"LEVEL" => "7",
		"SET_TITLE" => "N",
		"SHOW_DESCRIPTION" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>