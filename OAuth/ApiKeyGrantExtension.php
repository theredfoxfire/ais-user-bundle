<?php

namespace Ais\UserBundle\OAuth;

use Doctrine\Common\Persistence\ObjectRepository;
use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;
use OAuth2\Model\IOAuth2Client;

class ApiKeyGrantExtension implements GrantExtensionInterface
{
	private $userRepository;
	
	public function __construct(ObjectRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
	{
		$user = $this->userRepository->findOneByApikey($inputData['api_key']);
		
		if ($user) {
			
			return array(
				'data' => $user
			);
			
			return true;
		}
		return false;
	}
}
