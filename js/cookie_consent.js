var e107 = e107 || {'settings': {}, 'behaviors': {}};

(function ($)
{

	/**
	 * Behavior to initialize Cookie Consent.
	 *
	 * @type {{attach: Function}}
	 */
	e107.behaviors.cookieConsent = {
		attach: function (context, settings)
		{
			$(context).find('body').once('cookie-consent').each(function ()
			{
				window.cookieconsent_options = {
					message: settings.cookie_consent.message,
					dismiss: settings.cookie_consent.dismiss,
					learnMore: settings.cookie_consent.learnMore,
					link: settings.cookie_consent.link,
					container: settings.cookie_consent.container,
					theme: settings.cookie_consent.theme,
					path: settings.cookie_consent.path,
					domain: settings.cookie_consent.domain,
					expiryDays: settings.cookie_consent.expiryDays,
					target: settings.cookie_consent.target
				};

				if (window.update_cookieconsent_options)
				{
					window.update_cookieconsent_options(window.cookieconsent_options);
				}
			});
		}
	};

})(jQuery);
