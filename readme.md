# BlueMoonSoapWrapper

Wrapper around the Bluemoon SOAP API for Laravel.

## Installation

### Via Composer

``` bash
$ composer require primitivesocial/bluemoonsoapwrapper
```

### Via composer.json file for git repo
``` json
"repositories" : [
  ...,
  {
    "type": "package",
    "package": {
      "name": "primitivesocial/bluemoonsoapwrapper",
      "version": "0.0.1",
      "source": {
        "type" : "git",
        "url" : "git@github.com:PrimitiveSocial/bluemoon-soap-wrapper.git",
        "reference" : "0.0.1"
      },
      "dist": {
        "url": "https://github.com/PrimitiveSocial/bluemoon-soap-wrapper/archive/master.zip",
        "type": "zip"
      }
    }
  }
]
```

### Env vars
``` bash
BLUEMOON_CLIENT_URL=
BLUEMOON_CLIENT_SECRET=
BLUEMOON_CLIENT_ID=
BLUEMOON_USERNAME=
BLUEMOON_PASSWORD=
BLUEMOON_LICENSE=

BLUEMOON_SOAP_CLIENT_URL=
BLUEMOON_SOAP_USERNAME=
BLUEMOON_SOAP_PASSWORD=
BLUEMOON_SOAP_SERIAL=

BLUEMOON_APPLICATION_URL=
BLUEMOON_LEASE_URL=
BLUEMOON_APPLICATION_API_URL=
BLUEMOON_ESIGNATURE_API_URL=
BLUEMOON_DEBUG=true
```

You must add a config file called `bluemoon.php`. The package comes with one for all three Bluemoon setups out of the box.


``` php
<?php

return [
	// For use with REST api if you're using that
	'rest' => [
		'url' => env('BLUEMOON_CLIENT_URL'),
		'secret' => env('BLUEMOON_CLIENT_SECRET'),
		'id' => env('BLUEMOON_CLIENT_ID'),
		'username' => env('BLUEMOON_USERNAME'),
		'password' => env('BLUEMOON_PASSWORD'),
		'license' => env('BLUEMOON_LICENSE'),
	],
	// For user with SOAP api, so you need this
	'soap' => [
		'url' => env('BLUEMOON_SOAP_CLIENT_URL'),
		'username' => env('BLUEMOON_SOAP_USERNAME'),
		'password' => env('BLUEMOON_SOAP_PASSWORD'),
		'serial' => env('BLUEMOON_SOAP_SERIAL'),
	],
	// For use with in browser application
	'application' => [
		'api_url' => env('BLUEMOON_APPLICATION_API_URL'),
		'application_url' => env('BLUEMOON_APPLICATION_URL'),
		'esignature_url' => env('BLUEMOON_ESIGNATURE_API_URL'),
		'lease_url' => env('BLUEMOON_LEASE_URL'),
		'license' => env('BLUEMOON_LICENSE'),
		'debug' => env('BLUEMOON_DEBUG')
	]
];
```

You can also install the config by running `php artisan vendor:publish`.

## Usage

### Create New Wrapper
Params to create a new wrapper:
These will default to the config file if not specified.
clientSerial: Serial number of the property in BlueMoon. Useful if you are using with multiple properties
clientUrl: API Url you are using
clientUsername: SOAP API username
clientPassword: SOAP API password

### Commands
The wrapper will accept any command in the Bluemoon SOAP library and will give you unparsed data back.

``` php
$client = new BlueMoonSoapWrapper();

$result = $this->client->call(
					'lease',
					'GetEsignatureData',
					array(
                		'EsignatureId' => $esignature_id
            		)
			);
```

There are three required params:
`method`: The lowercase name of the Bluemoon category of data you are working with, i.e. `lease`, `application`
`fxn`: The SOAP function as appears in the documentation, i.e. `GetEsignatureData`
`data`: An array with all required fields sending to Bluemoon