<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
	if($catalog_messages = (new MoneyTv\CatalogMessageWhatsAppType)->getAll())
	{
		$data['catalog_messages'] = $catalog_messages;
		$data['r'] = 'DATA_OK';
		$data['s'] = 1;
	} else {
		$data['r'] = 'NOT_CATALOGS';
		$data['s'] = 0;
	}
} else {
	$data['r'] = 'INVALID_CREDENTIALS';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 