<?php define("TO_ROOT", "../../");

require_once TO_ROOT . "system/core.php"; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if(MoneyTv\ServicePerClient::requestFull(array_merge($data,['user_login_id'=> $UserLogin->company_id])))
    {
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_FULL_SERVICE';
        $data['s'] = 0;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 