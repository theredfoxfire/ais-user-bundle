<?php

namespace Ais\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
		} elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
		} else {
			$error = null;
		}

		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

		return $this->render(
			'security/login.html.twig',
			array(
				// last username entered by the user
				'last_username' => $lastUsername,
				'error'         => $error,
			)
		);
		//~ 
		//~ $user = new User();
		//~ $regForm = $this->createForm(new RegisterType(), $user, array(
			//~ 'method' => 'POST',
		//~ ));
		//~ $this->get('session')->getFlashBag()->add('notice', 'Login gagal, periksa kembali username & password Anda.');
//~ 
		//~ return $this->render('front/user/register.html.twig', array(
			//~ 'form' => $regForm->createView(),
		//~ ));
    }

    public function loginCheckAction()
    {
        throw new \Exception('This should never be reached!');
    }

    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}
