<?php define('TO_ROOT', '../../');

require_once TO_ROOT . 'system/core.php'; 

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{	
    $timeZone = $UserLogin->getTimeZone();

    if($conferences = (new MoneyTv\Conference)->getAll($timeZone))
    {
        $data['timezoneConfigurated'] = $UserLogin->hasTimeZoneConfigurated();
        $data['conferences'] = $conferences;
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_CONFERENCES';
        $data['s'] = 0;
    }
} else {
	$data['r'] = 'NOT_SESSION';
	$data['s'] = 0;
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 