<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Main\Context;

Bitrix\Main\Loader::includeModule("catalog");
Bitrix\Main\Loader::includeModule("sale");

function getProductsImage($elements) {
    $id = [];
    foreach ($elements as $element) $id[] = $element['id'];
    $arFilter = Array("IBLOCK_ID"=>IntVal(6), 'ID' => $id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $arSelect = Array('IBLOCK_ID',"ID", "NAME", "PREVIEW_PICTURE");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arFields = $res->GetNext()) {
        $image = CFile::GetPath($arFields['PREVIEW_PICTURE']);
        if(!empty( $elements[$arFields['ID']])) {
            $elements[$arFields['ID']]['image'] = $image;
        }
    }
    return $elements;
}


$actionType = $_POST['actionType'];
$product = [
    'id' => intval($_POST['product']['id']),
    'quantity' => intval($_POST['product']['quantity'])
];

$answer = [
    'type' => 'ok'
];
switch($actionType) {
    case 'addItem':
        $productId  = intval($product['id']);
        $quantity   = intval($product['quantity']);

        $fields = [
            'PRODUCT_ID' => $productId, // ID товара, обязательно
            'QUANTITY' => $quantity, // количество, обязательно
            'PROPS' => []
        ];

        $r = Bitrix\Catalog\Product\Basket::addProduct($fields);
        if (!$r->isSuccess()) {
            $answer = [
                'type' => 'error',
                'message' => $r->getErrorMessages()
            ];
        } else {
            $answer = [
                'type' => 'ok',
                'id' => $r->getData()['ID'],
            ];
        }
        break;
    case 'removeItem':
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        if($basket->getItemById($product['id'])->delete()) {
            $basket->save();
        } else {
            $answer['type'] = 'error';
        }
        break;
    case 'clear':
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        foreach ($basket as $basketItem) {
            $basketItem->delete();
        }
        break;
    case 'getCart':
        $basketRes = Sale\Internals\BasketTable::getList(array(
            'filter' => array(
                'FUSER_ID' => Sale\Fuser::getId(),
                'ORDER_ID' => null,
                'LID' => SITE_ID,
                'CAN_BUY' => 'Y',
            )
        ));
        while ($item = $basketRes->fetch()) {
            $answer['elements'][$item['PRODUCT_ID']] = [
                'id' => intval($item['PRODUCT_ID']),
                'name' => $item['NAME'],
                'url' => $item['DETAIL_PAGE_URL'],
                'price' => floatval($item['PRICE']),
                'lastPrice' => '',
                'basePrice' => floatval($item['BASE_PRICE']),
                'discountPrice' => floatval($item['DISCOUNT_PRICE']),
                'quantity' => intval($item['QUANTITY']),
                'cartId' => $item['ID']
            ];
        }
        if(!empty($answer['elements'])) {
            $answer['elements'] = getProductsImage($answer['elements']);
        }
        break;
}
echo json_encode($answer, JSON_UNESCAPED_UNICODE);
