<?php define("TO_ROOT", "../..");

require_once TO_ROOT . "/system/core.php";

$UserSupport = new MoneyTv\UserSupport;

if($UserSupport->_loaded === false) {
	HCStudio\Util::redirectTo('../../apps/admin-login/');
}

if($UserSupport->hasPermission('list_email') === false) {
	HCStudio\Util::redirectTo('../../apps/admin/invalid_permission');
}

$Layout = JFStudio\Layout::getInstance();

$route = JFStudio\Router::AdminEmail;
$Layout->init(JFStudio\Router::getName($route),"stats","admin","",TO_ROOT."/");

$Layout->setScriptPath(TO_ROOT . '/src/');
$Layout->setScript([
	'adminemailstats.vue.js'
]);

$Layout->setVar([
	'route' => $route,
	'UserSupport' => $UserSupport
]);
$Layout();