<?php

/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if(!e107::isInstalled('cookie_consent') || !getperms("P"))
{
	e107::redirect(e_BASE . 'index.php');
}

// [PLUGINS]/cookie_consent/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('cookie_consent', true, true);


/**
 * Class cookie_consent_admin.
 */
class cookie_consent_admin extends e_admin_dispatcher
{

	/**
	 * Required (set by child class).
	 *
	 * Controller map array in format.
	 * @code
	 *  'MODE' => array(
	 *      'controller' =>'CONTROLLER_CLASS_NAME',
	 *      'path' => 'CONTROLLER SCRIPT PATH',
	 *      'ui' => 'UI_CLASS', // extend of 'comments_admin_form_ui'
	 *      'uipath' => 'path/to/ui/',
	 *  );
	 * @endcode
	 *
	 * @var array
	 */
	protected $modes = array(
		'main' => array(
			'controller' => 'cookie_consent_admin_ui',
			'path'       => null,
		),
	);

	/**
	 * Optional (set by child class).
	 *
	 * Required for admin menu render. Format:
	 * @code
	 *  'mode/action' => array(
	 *      'caption' => 'Link title',
	 *      'perm' => '0',
	 *      'url' => '{e_PLUGIN}plugname/admin_config.php',
	 *      ...
	 *  );
	 * @endcode
	 *
	 * Note that 'perm' and 'userclass' restrictions are inherited from the $modes, $access and $perm, so you don't
	 * have to set that vars if you don't need any additional 'visual' control.
	 *
	 * All valid key-value pair (see e107::getNav()->admin function) are accepted.
	 *
	 * @var array
	 */
	protected $adminMenu = array(
		'main/prefs' => array(
			'caption' => LAN_COOKIE_CONSENT_ADMIN_01,
			'perm'    => 'P',
		),
	);

	/**
	 * Optional (set by child class).
	 *
	 * @var string
	 */
	protected $menuTitle = LAN_PLUGIN_COOKIE_CONSENT_NAME;

}


/**
 * Class cookie_consent_admin_ui.
 */
class cookie_consent_admin_ui extends e_admin_ui
{

	/**
	 * Could be LAN constant (multi-language support).
	 *
	 * @var string plugin name
	 */
	protected $pluginTitle = LAN_PLUGIN_COOKIE_CONSENT_NAME;

	/**
	 * Plugin name.
	 *
	 * @var string
	 */
	protected $pluginName = "cookie_consent";

	/**
	 * Example: array('0' => 'Tab label', '1' => 'Another label');
	 * Referenced from $prefs property per field - 'tab => xxx' where xxx is the tab key (identifier).
	 *
	 * @var array edit/create form tabs
	 */
	protected $preftabs = array(
		LAN_COOKIE_CONSENT_ADMIN_01,
	);

	/**
	 * Plugin Preference description array.
	 *
	 * @var array
	 */
	protected $prefs = array(
		'message'    => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_12,
			'description' => LAN_COOKIE_CONSENT_ADMIN_13,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'dismiss'    => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_14,
			'description' => LAN_COOKIE_CONSENT_ADMIN_15,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'learnMore'  => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_16,
			'description' => LAN_COOKIE_CONSENT_ADMIN_17,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'link'       => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_18,
			'description' => LAN_COOKIE_CONSENT_ADMIN_19,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'container'  => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_20,
			'description' => LAN_COOKIE_CONSENT_ADMIN_21,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'theme'      => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_10,
			'description' => LAN_COOKIE_CONSENT_ADMIN_11,
			'type'        => 'dropdown',
			'data'        => 'str',
			'writeParms'  => array(
				'optArray' => array(
					'light-floating'     => LAN_COOKIE_CONSENT_ADMIN_02,
					'light-bottom'       => LAN_COOKIE_CONSENT_ADMIN_03,
					'light-top'          => LAN_COOKIE_CONSENT_ADMIN_04,
					'dark-floating'      => LAN_COOKIE_CONSENT_ADMIN_05,
					'dark-floating-tada' => LAN_COOKIE_CONSENT_ADMIN_06,
					'dark-inline'        => LAN_COOKIE_CONSENT_ADMIN_07,
					'dark-bottom'        => LAN_COOKIE_CONSENT_ADMIN_08,
					'dark-top'           => LAN_COOKIE_CONSENT_ADMIN_09,
				),
			),
			'tab'         => 0,
		),
		'path'       => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_22,
			'description' => LAN_COOKIE_CONSENT_ADMIN_23,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'domain'     => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_24,
			'description' => LAN_COOKIE_CONSENT_ADMIN_25,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'expiryDays' => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_26,
			'description' => LAN_COOKIE_CONSENT_ADMIN_27,
			'type'        => 'number',
			'data'        => 'int',
			'tab'         => 0,
		),
		'target'     => array(
			'title'       => LAN_COOKIE_CONSENT_ADMIN_28,
			'description' => LAN_COOKIE_CONSENT_ADMIN_29,
			'type'        => 'text',
			'data'        => 'str',
			'tab'         => 0,
		),
		'cdn'        => array(
			'title'      => LAN_COOKIE_CONSENT_ADMIN_30,
			'type'       => 'boolean',
			'writeParms' => 'label=yesno',
			'data'       => 'int',
			'tab'        => 0,
		),
	);

	/**
	 * User defined init.
	 */
	public function init()
	{
		$prefs = e107::getPlugConfig('cookie_consent')->getPref();

		if (empty($prefs['domain']))
		{
			$this->fields['domain']['value'] = $_SERVER['HTTP_HOST'];
		}
	}

}


new cookie_consent_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
