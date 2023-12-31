<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if($Wallet = BlockChain\Wallet::getWallet($UserLogin->company_id))
    {
        $PrintPerBanner = new MoneyTv\PrintPerBanner;
        
        $data['banners'][] = $PrintPerBanner->getNextBanner($UserLogin->company_id,MoneyTv\CatalogBanner::BOTTOM_LEFT);
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_WALLET';
        $data['s'] = 1;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 