<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if($data['vcard_per_suer_id'])
    {
        $VCardPerUser = new MoneyTv\VCardPerUser;
        
        if($VCardPerUser->loadWhere('vcard_per_suer_id = ?',$data['vcard_per_suer_id']))
        { 
            $data['status'] = MoneyTv\VCardPerUser::DELETED;

            $VCardPerUser->status = $data['status'];
            
            if($VCardPerUser->save())
            {
                $data['r'] = 'DATA_OK';
                $data['s'] = 1;
            } else {
                $data['r'] = 'NOT_SAVE';
                $data['s'] = 0;
            }
        } else {
            $data['r'] = 'NOT_CAMPAIGN_BANNER_PER_USER';
            $data['s'] = 0;
        }
    } else {
        $data['r'] = 'NOT_VCARD_PER_SUER_ID';
        $data['s'] = 1;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 