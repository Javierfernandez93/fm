<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{
    if($licences = (new MoneyTv\LicencePerUser)->_getAll($UserLogin->company_id))
    {
        $data['licences'] = formatData($licences);
        $data['r'] = 'DATA_OK';
        $data['s'] = 1;
    } else {
        $data['r'] = 'NOT_LICENCES';
        $data['s'] = 1;
    }
} else {
	$data["s"] = 0;
	$data["r"] = "NOT_FIELD_SESSION_DATA";
}

function formatData(array $licences = null) : array {
    $UserAddress = new MoneyTv\UserAddress;
    $UserContact = new MoneyTv\UserContact;
    $Country = new World\Country;
    
    return array_map(function($licence) use($Country,$UserAddress,$UserContact) {
        $licence['country_id'] = $UserAddress->getCountryId($licence['user_login_id_to']);
        $licence['country'] = $Country->getCountryName($licence['country_id']);
        $licence['phone_code'] = $Country->getPhoneCodeByCountryId($licence['country_id']);
        $licence['phone'] = $UserContact->getPhone($licence['user_login_id_to']);
        
        return $licence;
    },$licences);
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 