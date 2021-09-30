# Codeigniter PHP framework example v3.1.1
## Now PHP builder on zeit.co

#### https://github.com/juicyfx/now-php

### Steps 

1. move the application, system folders along with the index.php into the api directory
2. Open api/index.php and replace

	1.  First change System Folder:

			$system_path = 'system'; // On line 100 v3.1.1

		replace with:

			$system_path = $_SERVER['DOCUMENT_ROOT'].'/api/'.'system';

	2.  Next, Change application folder:

			$application_folder = 'application'; // On line 117 v3.1.1

		replace with:

			$application_folder = $_SERVER['DOCUMENT_ROOT'].'/api/'.'application';


3. Open the application/config folder. (api/application/config/config.php)
       	Optional, only if composer is required

	1.	Change the composer autoload config

		Find the composer autoload section
		
			$config['composer_autoload'] = FALSE; //on line 139

		and replace it with

			$config['composer_autoload'] = APPPATH.'../../vendor/autoload.php';
	
			require_once APPPATH.'../../vendor/autoload.php';	

4. Update Your now.json

			{
				"version": 2,
				"public": true,
				"functions": {
				"api/*.php": {
					"runtime": "now-php@0.0.9"
				}
				},
				"routes": [
				{
					"src": "/assets/(.*)",
					"headers": {
					"cache-control": "s-maxage=604800"
					},
					"dest": "/assets/$1"
				},
				{
					"src": "/(.*)",
					"dest": "api/index.php"
				}
				]
			}