<?php define("TO_ROOT", "../../");

require_once TO_ROOT . "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{
    if($data['invoice_id'])
	{
        $BuyPerUser = new MoneyTv\BuyPerUser;

		if($BuyPerUser->loadWhere('invoice_id = ?',$data['invoice_id']))
		{
			$data['invoice'] = $BuyPerUser->unformatData();
            $data['s'] = 1;
            $data['r'] = 'DATA_OK';
		} else {
			$data['s'] = 0;
			$data['r'] = 'NOT_CATALOG_PAYMENT_METHOD_ID';
		}		
	} else {
		$data['s'] = 0;
		$data['r'] = 'NOT_BUY_PER_USER_ID';
	}
} else {
	$data['s'] = 0;
	$data['r'] = 'INVALID_CREDENTIALS';
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 