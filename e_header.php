<?php

/**
 * @file
 * Class instantiation to prepare JavaScript configurations and include css/js
 * files to page header.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class cookie_consent_e_header.
 */
class cookie_consent_e_header
{

	/**
	 * Constructor.
	 */
	function __construct()
	{
		self::include_components();
	}


	/**
	 * Include necessary CSS and JS files
	 */
	function include_components()
	{
		$prefs = e107::getPlugConfig('cookie_consent')->getPref();

		$settings = array(
			'message'    => deftrue($prefs['message'], $prefs['message']),
			'dismiss'    => deftrue($prefs['dismiss'], $prefs['dismiss']),
			'learnMore'  => deftrue($prefs['learnMore'], $prefs['learnMore']),
			'link'       => !empty($prefs['link']) ? $prefs['link'] : null,
			'container'  => !empty($prefs['container']) ? $prefs['container'] : null,
			'theme'      => vartrue($prefs['theme'], 'light-floating'),
			'path'       => vartrue($prefs['path'], '/'),
			'domain'     => vartrue($prefs['domain'], $_SERVER['HTTP_HOST']),
			'expiryDays' => vartrue($prefs['expiryDays'], 365),
			'target'     => vartrue($prefs['target'], '_self'),
		);

		e107::js('settings', array('cookie_consent' => $settings));
		e107::js('cookie_consent', 'js/cookie_consent.js', 'jquery', 4);
	}

}


// Class instantiation.
new cookie_consent_e_header;