<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if($data['whatsapp_campaign_id'])
    {
        if($schedules = (new MoneyTv\WhatsAppMessageSchedule)->getAll($data['whatsapp_campaign_id']))
        {
            $data['schedules'] = $schedules;
            $data['r'] = 'DATA_OK';
            $data['s'] = 1;
        } else {
            $data['r'] = 'NOT_SCHEDULES';
            $data['s'] = 0;
        }
    } else {
        $data['r'] = 'NOT_WHATSAPP_CAMPAIGN_ID';
        $data['s'] = 0;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 