<?php define("TO_ROOT", "../../");

require_once TO_ROOT . "/system/core.php";

$data = HCStudio\Util::getHeadersForWebService();

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === true)
{
    $data['user_login_id'] = $UserLogin->company_id;

    if($unique_id = MoneyTv\TicketPerUser::saveTicket($data))
    {
        sendWhatsApp($unique_id);

        $data['s'] = 1;
        $data['r'] = 'DATA_OK';
    } else {
        $data['s'] = 0;
        $data['r'] = 'NOT_TICKETS';
    }		
} else {
	$data['s'] = 0;
	$data['r'] = 'INVALID_CREDENTIALS';
}

function sendWhatsApp(string $unique_id = null) 
{
    return MoneyTv\ApiWhatsApp::sendWhatsAppMessage([
        'message' => MoneyTv\ApiWhatsAppMessages::getTicketCreatedMessage(),
        'image' => null,
        'contact' => [
            "phone" => '+5213317361196',
            "name" => 'Javier',
            "extra" => $unique_id
        ]
    ]);
}

echo json_encode(HCStudio\Util::compressDataForPhone($data)); 