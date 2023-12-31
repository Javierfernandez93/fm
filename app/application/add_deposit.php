<?php define("TO_ROOT", "../../");

require_once TO_ROOT. "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserSupport = new MoneyTv\UserSupport;

if($UserSupport->_loaded === true)
{
    $UserWallet = new MoneyTv\UserWallet;
    
    if($UserWallet->getSafeWallet(($data['user_login_id'])))
    {
        if($UserWallet->doTransaction($data['ammount'],MoneyTv\Transaction::DEPOSIT,null,null,false))
        {
            $UserPlan = new MoneyTv\UserPlan;

            if($UserPlan->setPlan($data['user_login_id']))
            {
                $data["s"] = 1;
                $data["r"] = "DATA_OK";
            } else {
                $data["s"] = 0;
                $data["r"] = "NOT_UPDATE_PLAN";
            }
        } else {
            $data['r'] = "NOT_TRANSACTION_MADE";
            $data['s'] = 0;    
        }
    } else {
        $data['r'] = "NOT_WALLET";
        $data['s'] = 0;
    }
} else {
	$data["s"] = 0;
	$data["r"] = "NOT_FIELD_SESSION_DATA";
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 