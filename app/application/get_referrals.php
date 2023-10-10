<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{
    if($referrals = (new MoneyTv\UserReferral)->getReferrals($UserLogin->company_id))
    {
        $data['referrals'] = formatData($referrals);
        $data["s"] = 1;
        $data["r"] = "DATA_OK";
    } else {
        $data["s"] = 0;
        $data["r"] = "NOT_DATA";
    }
} else {
	$data["s"] = 0;
	$data["r"] = "INVALID_CREDENTIALS";
}

function formatData(array $referrals = null) : array {
    $LicencePerUser = new MoneyTv\LicencePerUser;
    $Country = new World\Country;
    
    return array_map(function($referral) use($Country,$LicencePerUser) {
        $referral['country'] = $Country->getCountryName($referral['country_id']);
        $referral['phone_code'] = $Country->getPhoneCodeByCountryId($referral['country_id']);
        $referral['active'] = $LicencePerUser->isActive($referral['user_login_id']);

        return $referral;
    },$referrals);
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 