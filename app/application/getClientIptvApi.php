<?php define("TO_ROOT", "../../");

require_once TO_ROOT . "system/core.php"; 

$data = HCStudio\Util::getHeadersForWebService();

$UserSupport = new MoneyTv\UserSupport;

if($UserSupport->_loaded === true)
{	
    if($data['user_name'])
    {
        if($user = MoneyTv\ApiMoneyTv::getUser($data['user_name']))
        {
            $data['user'] = $user;
            $data['r'] = 'DATA_OK';
            $data['s'] = 1;
        } else {
            $data['r'] = 'NOT_SEND_WHATSAPP';
            $data['s'] = 1;
        }
    } else {
        $data['r'] = 'NOT_CLIENT_ID';
        $data['s'] = 0;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 