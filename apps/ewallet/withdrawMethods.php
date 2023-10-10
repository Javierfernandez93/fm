<?php define("TO_ROOT", "../..");

require_once TO_ROOT . "/system/core.php";

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === false) {
	HCStudio\Util::redirectTo(TO_ROOT."/apps/login/");
}

$Layout = JFStudio\Layout::getInstance();

$route = JFStudio\Router::WithdrawMethods;
$Layout->init(JFStudio\Router::getName($route),'withdrawMethods','backoffice','',TO_ROOT.'/');

$Layout->setScriptPath(TO_ROOT . '/src/');
$Layout->setScript([
	'withdrawmethods.vue.js'
]);

$Layout->setVar([
	'route' => $route,
	'UserLogin' => $UserLogin
]);
$Layout();