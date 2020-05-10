<?php
/**
	* Aponkral PHPkoru Firewall
	* Website: https://phpkoru.com/
	* Firewall: https://phpkoru.com/firewall/
	* Developer Website: https://aponkral.dev/
	*
	* Version: v1.0.2
	*
*/
// Her şeyi sana yazdım!.. Her şeye seni yazdım!.. *Mustafa Kemal ATATÜRK

$pf_enabled = true; // Setting to activate or deactivate PHPkoru Firewall

$pf_setting_whitelist_ips = false; // Setting to enable or disable the whitelist feature. It can be set from the $whitelist_ips variable on line 40.
$pf_cookie_sec_key = "PHPkoru-Firewall"; //Editable for security

// That’s all, stop editing! Do not edit or change the following codes.

// Whitelist Feature Started
if ($pf_setting_whitelist_ips == true)
{
	function pf_ip_in_range($ip, $range) {
		if (strpos($range, "/") == false) {
			$range .= "/32";
		}
		list($range, $netmask) = explode("/", $range, 2);
		$range_decimal = ip2long($range);
		unset($range);
		$ip_decimal = ip2long($ip);
		unset($ip);
		$wildcard_decimal = pow(2, (32 - $netmask) ) - 1;
		unset($netmask);
		$netmask_decimal = ~ $wildcard_decimal;
		unset($wildcard_decimal);
		return(($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
		unset($range_decimal, $ip_decimal, $netmask_decimal);
	}

	$whitelist_ips = [
	"127.0.0.1",
	"1.1.1.1/32"
	];

	$whitelist_allowed = false;
	foreach ($whitelist_ips as $whitelist_ip)
	{
	if (pf_ip_in_range($_SERVER["REMOTE_ADDR"], $whitelist_ip) == true)
		$whitelist_allowed = true;
	unset($whitelist_ip);
	}
	unset($whitelist_ips);
}
unset($pf_setting_whitelist_ips);

if ($whitelist_allowed == true)
{
	unset($whitelist_allowed);
	$pf_enabled = false;
}
// Whitelist Feature Ended

if ($pf_enabled == true)
{
unset($pf_enabled);

$pf_https = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") ? true : false;
$pf_domain = (isset($_SERVER["HTTP_HOST"]) && !empty(trim($_SERVER["HTTP_HOST"]))) ? $_SERVER["HTTP_HOST"] : "phpkoru.com";

$pf_remote_ip = (isset($_SERVER["REMOTE_ADDR"]) && !empty($_SERVER["REMOTE_ADDR"])) ? $_SERVER["REMOTE_ADDR"] : "";
$pf_user_agent = (isset($_SERVER["HTTP_USER_AGENT"]) && !empty(trim($_SERVER["HTTP_USER_AGENT"]))) ? $_SERVER["HTTP_USER_AGENT"] : "";
$pf_sec_token = sha1($pf_cookie_sec_key.$pf_domain.$pf_remote_ip.$pf_user_agent);
unset($pf_cookie_sec_key, $pf_remote_ip, $pf_user_agent);

if ((!isset($_COOKIE["__pf"]) || empty($_COOKIE["__pf"])) || ((isset($_COOKIE["__pf"]) && !empty(trim($_COOKIE["__pf"]))) && $pf_sec_token !== $_COOKIE["__pf"]))
{
	http_response_code(200);
	header("Content-Type: text/html; charset=utf-8");
	$pf_redirect_url = ($pf_https === true) ? "https://" : "http://";
	$pf_redirect_url .= $pf_domain;
	$pf_redirect_url .= (isset($_SERVER["REQUEST_URI"]) && !empty(trim($_SERVER["REQUEST_URI"]))) ? $_SERVER["REQUEST_URI"] : "/";
	$pf_setcookie_js = "function phpkoru(f,i,r,e,w,a,l,l)
{
	var _0x36fd=['".base64_encode("__pf")."','cookie','".base64_encode($pf_redirect_url)."',';\x20path=/;\x20domain=','replace'];(function(_0x4e7145,_0x36fd29){var _0x4d0d98=function(_0x31a569){while(--_0x31a569){_0x4e7145['push'](_0x4e7145['shift']());}};_0x4d0d98(++_0x36fd29);}(_0x36fd,0x1ad));var _0x4d0d=function(_0x4e7145,_0x36fd29){_0x4e7145=_0x4e7145-0x0;var _0x4d0d98=_0x36fd[_0x4e7145];return _0x4d0d98;};document[_0x4d0d('0x2')]=atob(_0x4d0d('0x1'))+'='+atob('".base64_encode($pf_sec_token)."')+_0x4d0d('0x4')+atob('".base64_encode($pf_domain)."')+';';setTimeout(function(){window['location'][_0x4d0d('0x0')](atob(_0x4d0d('0x3')));},0x32);
}
phpkoru('f','i','r','e','w','a','l','l');";
	exit("<html><head><title>Redirecting... - PHPkoru Firewall</title></head><body><script type=\"text/javascript\">".$pf_setcookie_js."</script><noscript><h1 style=\"color:#bd2426;\">Please turn JavaScript on and reload the page.</h1></noscript></body><html>");
	unset($pf_redirect_url, $setcookie_js);
}
unset($pf_https, $pf_domain);

if (isset($pf_sec_token))
	unset($pf_sec_token);
}
else
	unset($pf_enabled, $pf_cookie_sec_key);
?>