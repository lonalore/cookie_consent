<?php

/**
 * @file
 * Provides information about external libraries.
 */


/**
 * Class PLUGIN_library.
 */
class cookie_consent_library
{

	/**
	 * Return information about external libraries.
	 *
	 * @return
	 *   An associative array whose keys are internal names of libraries and whose values are describing each library.
	 *   Each key is the directory name below the '{e_WEB}/lib' directory, in which the library may be found. Each
	 *   value is an associative array containing:
	 *   - name: The official, human-readable name of the library.
	 *   - vendor url: The URL of the homepage of the library.
	 *   - download url: The URL of a web page on which the library can be obtained.
	 *   - path: (optional) A relative path from the directory of the library to the actual library. Only required if
	 *     the extracted download package contains the actual library files in a sub-directory.
	 *   - library path: (optional) The absolute path to the library directory. This should not be declared normally, as
	 *     it is automatically detected, to allow for multiple possible library locations. A valid use-case is an
	 *     external library, in which case the full URL to the library should be specified here.
	 *   - version: (optional) The version of the library. This should not be declared normally, as it is automatically
	 *     detected (see 'version callback' below) to allow for version changes of libraries without code changes of
	 *     implementing plugins and to support different versions of a library simultaneously. A valid use-case is an
	 *     external library whose version cannot be determined programmatically. Either 'version' or 'version callback'
	 *     (or 'version arguments' in case libraryGetVersion() is being used as a version callback) must be declared.
	 *   - version callback: (optional) The name of a function that detects and returns the full version string of the
	 *     library. The first argument is always $library, an array containing all library information as described here.
	 *     There are two ways to declare the version callback's additional arguments, either as a single $options
	 *     parameter or as multiple parameters, which correspond to the two ways to specify the argument values (see
	 *     'version arguments'). Defaults to libraryGetVersion(). Unless 'version' is declared or libraryGetVersion()
	 *     is being used as a version callback, 'version callback' must be declared. In the latter case, however,
	 *     'version arguments' must be declared in the specified way.
	 *   - version arguments: (optional) A list of arguments to pass to the version callback. Version arguments can be
	 *     declared either as an associative array whose keys are the argument names or as an indexed array without
	 *     specifying keys. If declared as an associative array, the arguments get passed to the version callback as a
	 *     single $options parameter whose keys are the argument names (i.e. $options is identical to the specified
	 *     array). If declared as an indexed array, the array values get passed to the version callback as separate
	 *     arguments in the order they were declared. The default version callback libraryGetVersion() expects a
	 *     single, associative array with named keys:
	 *     - file: The filename to parse for the version, relative to the path specified as the 'library path' property
	 *       (see above). For example: 'docs/changelog.txt'.
	 *     - pattern: A string containing a regular expression (PCRE) to match the library version. For example:
	 *       '@version\s+([0-9a-zA-Z\.-]+)@'. Note that the returned version is not the match of the entire pattern
	 *       (i.e. '@version 1.2.3' in the above example) but the match of the first sub-pattern (i.e. '1.2.3' in the
	 *       above example).
	 *     - lines: (optional) The maximum number of lines to search the pattern in. Defaults to 20.
	 *     - cols: (optional) The maximum number of characters per line to take into account. Defaults to 200. In case
	 *       of minified or compressed files, this prevents reading the entire file into memory.
	 *     Defaults to an empty array. 'version arguments' must be specified unless 'version' is declared or the
	 *     specified 'version callback' does not require any arguments. The latter might be the case with a
	 *     library-specific version callback, for example.
	 *   - files: An associative array of library files to load. Supported keys are:
	 *     - js: A list of JavaScript files to load.
	 *     - css: A list of CSS files to load.
	 *     - php: A list of PHP files to load.
	 *   - dependencies: An array of libraries this library depends on. Similar to declaring plugin dependencies, the
	 *     dependency declaration may contain information on the supported version. Examples of supported declarations:
	 * @code
	 *     $library['dependencies'] = array(
	 *       // Load the 'example' library, regardless of the version available:
	 *       'example',
	 *       // Only load the 'example' library, if version 1.2 is available:
	 *       'example (1.2)',
	 *       // Only load a version later than 1.3-beta2 of the 'example' library:
	 *       'example (>1.3-beta2)'
	 *       // Only load a version equal to or later than 1.3-beta3:
	 *       'example (>=1.3-beta3)',
	 *       // Only load a version earlier than 1.5:
	 *       'example (<1.5)',
	 *       // Only load a version equal to or earlier than 1.4:
	 *       'example (<=1.4)',
	 *       // Combinations of the above are allowed as well:
	 *       'example (>=1.3-beta2, <1.5)',
	 *     );
	 * @endcode
	 *   - variants: (optional) An associative array of available library variants. For example, the top-level 'files'
	 *     property may refer to a default variant that is compressed. If the library also ships with a minified and
	 *     uncompressed/source variant, those can be defined here. Each key should describe the variant type, e.g.
	 *     'minified' or 'source'. Each value is an associative array of top-level properties that are entirely
	 *     overridden by the variant, most often just 'files'. Additionally, each variant can contain following
	 *     properties:
	 *     - variant callback: (optional) The name of a function that detects the variant and returns TRUE or FALSE,
	 *       depending on whether the variant is available or not. The first argument is always $library, an array
	 *       containing all library information as described here. The second argument is always a string containing the
	 *       variant name. There are two ways to declare the variant callback's additional arguments, either as a single
	 *       $options parameter or as multiple parameters, which correspond to the two ways to specify the argument
	 *       values (see 'variant arguments'). If omitted, the variant is expected to always be available.
	 *     - variant arguments: A list of arguments to pass to the variant callback. Variant arguments can be declared
	 *       either as an associative array whose keys are the argument names or as an indexed array without specifying
	 *       keys. If declared as an associative array, the arguments get passed to the variant callback as a single
	 *       $options parameter whose keys are the argument names (i.e. $options is identical to the specified array).
	 *       If declared as an indexed array, the array values get passed to the variant callback as separate arguments
	 *       in the order they were declared.
	 *     Variants can be version-specific (see 'versions').
	 *   - versions: (optional) An associative array of supported library versions. Naturally, libraries evolve over
	 *     time and so do their APIs. In case a library changes between versions, different 'files' may need to be
	 *     loaded, different 'variants' may become available, or e107 plugins need to load different integration files
	 *     adapted to the new version. Each key is a version *string* (PHP does not support floats as keys). Each value
	 *     is an associative array of top-level properties that are entirely overridden by the version.
	 *   - integration files: (optional) Sets of files to load for the plugin, using the same notion as the top-level
	 *     'files' property. Each specified file should contain the path to the file relative to the plugin it belongs
	 *     to.
	 *   Additional top-level properties can be registered as needed.
	 */
	function config()
	{
		// Silktide's 'cookieconsent2' library.
		$libraries['cookieconsent2'] = array(
			'name'              => 'Cookie Consent',
			'vendor_url'        => 'https://github.com/silktide/cookieconsent2',
			'download_url'      => 'https://github.com/silktide/cookieconsent2/archive/master.zip',
			'version_arguments' => array(
				'file'    => 'package.json',
				// "version": "1.0.10"
				'pattern' => '/"version": "(\d+\.+\d+\.+\d+)"/',
				'lines'   => 5,
			),
			'files'             => array(
				'css' => array(
					'build/dark-bottom.css',
					'build/dark-floating.css',
					'build/dark-floating-tada.css',
					'build/dark-inline.css',
					'build/dark-top.css',
					'build/light-bottom.css',
					'build/light-floating.css',
					'build/light-top.css',
				),
				'js'  => array(
					'build/cookieconsent2.min.js' => array(
						'type' => 'footer',
					),
				),
			),
		);

		// Silktide's 'cookieconsent2' CDN library.
		$libraries['cdn.cookieconsent2'] = array(
			'name'             => 'Cookie Consent',
			'vendor_url'       => 'https://github.com/silktide/cookieconsent2',
			'version_callback' => 'cdn_cookieconsent2_version_callback',
			// Override library path to CDN.
			'library_path'     => 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/',
			'files'            => array(
				'js' => array(
					'cookieconsent.min.js' => array(
						'type' => 'footer',
					),
				),
			),
		);

		return $libraries;
	}

	/**
	 * Version callback to provide version number for CDN library.
	 */
	function cdn_cookieconsent2_version_callback()
	{
		return '1.0.10';
	}

	/**
	 * Alter the library information before detection and caching takes place.
	 *
	 * The library definitions are passed by reference. A common use-case is adding a plugin's integration files to the
	 * library array, so that the files are loaded whenever the library is. As noted above, it is important to declare
	 * integration files inside of an array, whose key is the plugin name.
	 */
	function config_alter(&$libraries)
	{
		$prefs = e107::getPlugConfig('cookie_consent')->getPref();

		if((int) vartrue($prefs['cdn'], 0) === 0)
		{
			$theme = vartrue($prefs['theme'], 'light-floating');
			$css = 'build/' . $theme . '.css';

			foreach($libraries['cookieconsent2']['files']['css'] as $item)
			{
				if($item != $css)
				{
					unset($libraries['cookieconsent2']['files']['css'][$css]);
				}
			}
		}
	}

}
