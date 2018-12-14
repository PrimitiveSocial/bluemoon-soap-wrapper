<?php

namespace PrimitiveSocial\BlueMoonSoapWrapper;

// use GuzzleHttp\Exception\GuzzleException;
// use GuzzleHttp\Client;
use Zend\Soap\Client;

class BlueMoonSoapWrapper
{
	protected $clientUrl;

	protected $clientUsername;

	protected $clientPassword;

	protected $clientSerial;

	protected $token;

	protected $selectedMethod;

	protected $selectedFunction;

	private $client;

	private $inData;

	private $sendData;

	private $library;

	public function __construct($clientUrl = null, $clientUsername = null, $clientPassword = null, $clientSerial = null) {

		$this->clientUrl = $clientUrl ?: config('bluemoon.soap.url');
		$this->clientUsername = $clientUsername ?: config('bluemoon.soap.username');
		$this->clientPassword = $clientPassword ?: config('bluemoon.soap.password');
		$this->clientSerial = $clientSerial ?: config('bluemoon.soap.serial');

	}

	public function call($method, $fxn, $data) {

		$this->selectedMethod = $method;

		$this->selectedFunction = $fxn;

		// Create client
		$this->client = new Client($this->clientUrl . '/services/' . $this->selectedMethod . '.php?wsdl');

		// Get token
		$this->token = $this->login();

		// Create data object with Session ID
		$this->inData = array_merge(
			array(
				'SessionId' => $this->token
			),
			$data
		);

		try {

			$result = $this->sendRequest($this->inData);

		} catch (\Exception $e) {

			$result = array(
				'error' => $e->getMessage(),
				'request' => $this->client->getLastRequest()
			);

		}

		return $result;

	}

	private function login() {

		$loginArray = array(
			'SerialNumber' => $this->clientSerial,
			'UserId' => $this->clientUsername,
			'Password' => $this->clientPassword
		);

		$response = $this->client->CreateSession($loginArray);

		return $response->CreateSessionResult;

	}

	private function sendRequest($data) {

		$response = $this->client->{$this->selectedFunction}($data);

		return $response->{$this->selectedFunction . 'Result'};

	}

}