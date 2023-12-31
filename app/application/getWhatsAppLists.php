<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true) 
{	
    if($lists = (new MoneyTv\WhatsAppListPerUser)->getAll($UserLogin->company_id))
    {
        $data['lists'] = format($lists);
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_LISTS';
        $data['s'] = 0;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

function format(array $lists = null) : array {
    $ContactPerWhatsAppList = new MoneyTv\ContactPerWhatsAppList;

    return array_map(function($list) use($ContactPerWhatsAppList) {
        $list['contact'] = $ContactPerWhatsAppList->getCount($list['whatsapp_list_per_user_id']);
        return $list;
    },$lists);
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 