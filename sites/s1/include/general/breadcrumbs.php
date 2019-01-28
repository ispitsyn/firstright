<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->SetViewTarget('breadcrumbs');?>
<section class="content-header content-header_products">
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
</section>
<?$this->EndViewTarget();?>

