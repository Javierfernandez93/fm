<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{
    if($data['invoice_id'])
	{
        $BuyPerUser = new MoneyTv\BuyPerUser;
        
        if($BuyPerUser->isInvoicePending($data['invoice_id']))
        {
            if($BuyPerUser->loadWhere('invoice_id = ?',$data['invoice_id']))
            {	
                if(MoneyTv\BuyPerUser::deletePayment($BuyPerUser->getId()))
                {
                    $data['status'] = MoneyTv\BuyPerUser::DELETED;
                    $data['s'] = 1;
                    $data['r'] = 'SAVE_OK';
                } else {
                    $data['s'] = 0;
                    $data['r'] = 'NOT_PROCESSED';
                }
            } else {
                $data['s'] = 0;
                $data['r'] = 'NOT_SAVE';
            } 		
        } else {
            $data['s'] = 0;
            $data['r'] = 'NOT_PEDNING';
        } 		
	} else {
		$data['s'] = 0;
		$data['r'] = 'NOT_INVOICE_ID';
	}
} else {
	$data["s"] = 0;
	$data["r"] = "NOT_FIELD_SESSION_DATA";
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 