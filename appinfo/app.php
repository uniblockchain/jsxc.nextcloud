<?php

/**
 * nextcloud - JavaScript XMPP Chat
 *
 * Copyright (c) 2014-2015 Klaus Herberth <klaus@jsxc.org> <br>
 * Released under the MIT license
 * @author Klaus Herberth <klaus@jsxc.org>
 */
OCP\App::registerAdmin ( 'njsxc', 'settings' );

$jsxc_root = (defined('JSXC_ENV') && JSXC_ENV === 'dev')? 'jsxc/dev/' : 'jsxc/';

OCP\Util::addScript ( 'njsxc', $jsxc_root.'lib/jquery.slimscroll' );
OCP\Util::addScript ( 'njsxc', $jsxc_root.'lib/jquery.fullscreen' );
OCP\Util::addScript ( 'njsxc', $jsxc_root.'lib/jsxc.dep' );
OCP\Util::addScript ( 'njsxc', $jsxc_root.'jsxc' );
OCP\Util::addScript('njsxc', 'jsxc.nextcloud');

// ############# CSS #############
OCP\Util::addStyle ( 'njsxc', 'jsxc.nextcloud' );

if(class_exists('\\OCP\\AppFramework\\Http\\EmptyContentSecurityPolicy')) {
	$manager = \OC::$server->getContentSecurityPolicyManager();
	$policy = new \OCP\AppFramework\Http\EmptyContentSecurityPolicy();

	$policy->addAllowedStyleDomain('\'self\'');
	$policy->addAllowedStyleDomain('\'unsafe-inline\'');

	$policy->addAllowedScriptDomain('\'self\'');

	$policy->addAllowedImageDomain('\'self\'');
	$policy->addAllowedImageDomain('data:');
	$policy->addAllowedImageDomain('blob:');

	$policy->addAllowedMediaDomain('\'self\'');
	$policy->addAllowedMediaDomain('blob:');

	$policy->addAllowedChildSrcDomain('\'self\'');

	$policy->addAllowedConnectDomain('\'self\'');

	$boshUrl = \OC::$server->getConfig()->getAppValue('njsxc', 'boshUrl');

	if(preg_match('#^(https?:)?//([a-z0-9][a-z0-9\-.]*[a-z0-9](:[0-9]+)?)/#i', $boshUrl, $matches)) {
		$boshDomain = $matches[2];

		$policy->addAllowedConnectDomain($boshDomain);
	}

	$manager->addDefaultPolicy($policy);
}

require_once __DIR__ ."/../vendor/autoload.php";

?>
