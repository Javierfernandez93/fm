<?php define('TO_ROOT', '../../');

require_once TO_ROOT. '/system/core.php';

$data = HCStudio\Util::getHeadersForWebService();

$UserSupport = new MoneyTv\UserSupport;

if($UserSupport->_loaded === true)
{
    if($data['campaign_email_id'])
    {
        if($emails = (new MoneyTv\EmailPerCampaign)->getAll($data['campaign_email_id']))
        {
            $data['emails'] = $emails;
            $data['s'] = 1;
            $data['r'] = 'DATA_OK';
        } else {
            $data['s'] = 0;
            $data['r'] = 'NOT_EMAILS';
        }
    } else {
        $data['s'] = 1;
        $data['r'] = 'DATA_OK';
    }
} else {
    $data['s'] = 0;
    $data['r'] = 'NOT_FIELD_SESSION_DATA';
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 