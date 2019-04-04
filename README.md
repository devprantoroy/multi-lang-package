# Pranto Multilanguage
Pranto Multilanguage is a **dynamic multi-language** system. Where admin can easily add/romove language as he likes.
## Requirements
- PHP >= 5.4
## Composer Installation
Installation is straightforward, setup is similar to every other Laravel Package.

`
composer require pranto/multi-language

`

**Note**: This package supports the new auto-discovery features of Laravel 5.5, so if you are working on a Laravel 5.5 project, then your install is complete, you can skip to step 3.

If you are using Laravel 5.0 - 5.4 then you need to add a provider and alias. Inside of your config/app.php define a new service provider

`
'providers' => [
	//  other providers
	Pranto\MultiLanguage\MultiLanguageServiceProvider::class,
];

`


