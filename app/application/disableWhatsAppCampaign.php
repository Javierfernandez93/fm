<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if($data['whatsapp_campaign_id'])
    {
        $WhatsAppCampaign = new MoneyTv\WhatsAppCampaign;
        
        if($WhatsAppCampaign->loadWhere('whatsapp_campaign_id = ?',$data['whatsapp_campaign_id']))
        {
            $data['status'] = JFStudio\Constants::DISABLED;

            $WhatsAppCampaign->status = $data['status'];

            if($WhatsAppCampaign->save())
            {
                $data['r'] = 'SAVE_OK';
                $data['s'] = 1;
            }  else {
                $data['r'] = 'NOT_SAVE';
                $data['s'] = 0;
            }
        } else {
            $data['r'] = 'NOT_WHATSAPP_CAMPAIGN';
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