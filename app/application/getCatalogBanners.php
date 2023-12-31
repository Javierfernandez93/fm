<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    if($catalogBanners = (new MoneyTv\CatalogBanner)->getAll())
    {
        $data['catalogBanners'] = format($catalogBanners);
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_CAMPAIGNS';
        $data['s'] = 1;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

function format(array $catalogBanners = null) : array
{
    return array_map(function($catalogBanner){
        return $catalogBanner;
    },$catalogBanners);
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 