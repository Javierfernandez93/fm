<?php define("TO_ROOT", "../..");

require_once TO_ROOT . "/system/core.php";

$UserLogin = new MoneyTv\UserLogin;

if($UserLogin->_loaded === false) {
	HCStudio\Util::redirectTo(TO_ROOT."/apps/login/");
}

$UserLogin->checkRedirection();

$Layout = JFStudio\Layout::getInstance();

$route = JFStudio\Router::StoreNetwork;
$Layout->init(JFStudio\Router::getName($route),'package',"backoffice",'',TO_ROOT.'/');

$Layout->setScriptPath(TO_ROOT . '/src/');
$Layout->setScript([
	'store.css',
	'store.vue.js',
]);

$Layout->setVar([
	'route' =>  $route,
	'setApp' =>  true,
	'UserLogin' => $UserLogin
]);
$Layout();