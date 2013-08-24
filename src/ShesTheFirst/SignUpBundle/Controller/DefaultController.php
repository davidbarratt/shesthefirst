<?php

namespace ShesTheFirst\SignUpBundle\Controller;

use ShesTheFirst\SignUpBundle\Entity\Contact;
use ShesTheFirst\SignUpBundle\Entity\Facebook;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        $login_url = NULL;
        $logout_url = NULL;
        $facebook_user = NULL;
        $contact = NULL;
        $user_profile = array();
        $applications = array();
        $signups = FALSE;
        $admin = FALSE;
        
        $facebook = new \Facebook(array(
          'appId'  => $this->container->getParameter('shes_the_first_sign_up.facebook.app_id'),
          'secret' => $this->container->getParameter('shes_the_first_sign_up.facebook.secret'),
        ));
        
        $user = $facebook->getUser();
        
        if ($user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $facebook->api('/me');
          } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
          }
        }
                
        if ($user) {
        
          $facebook_repository = $this->getDoctrine()->getRepository('ShesTheFirstSignUpBundle:Facebook');
          $contact_repository = $this->getDoctrine()->getRepository('ShesTheFirstSignUpBundle:Contact');
        
          $facebook_user = $facebook_repository->findOneBy(array('id' => $user));
              
          if (!$facebook_user) {
          
            $facebook_user = new Facebook();
            $facebook_user->setId($user);
            
            $created = new \DateTime('now', new \DateTimeZone('UTC'));
            
            $contact = new Contact();
          
            $contact->setCreated($created);
            
          }
          else {
            $contact = $facebook_user->getContact();
          }
          
          $facebook_user->setUsername($user_profile['username']);
          $contact->setFirstName($user_profile['first_name']);
          $contact->setLastName($user_profile['last_name']);
          $contact->setEmail($user_profile['email']);
          
          $updated = new \DateTime('now', new \DateTimeZone('UTC'));
          
          $contact->setUpdated($updated);
          
          $facebook_user->setAccessToken($facebook->getAccessToken());
          
          $facebook_user->setContact($contact);
      
          $em = $this->getDoctrine()->getManager();
          $em->persist($contact);
          $em->flush();
          $em->persist($facebook_user);
          $em->flush();
          
          $params = array(
            'next' => $this->generateUrl('shes_the_first_sign_up_logout', array(), true),
          );
          
          $logout_url = $facebook->getLogoutUrl($params);
          
          try {
            $applications = $facebook->api(array(
               'method' => 'fql.query',
               'query' => 'SELECT application_id, role FROM developer WHERE developer_id = '.$user,
            ));
          } catch (FacebookApiException $e) {
            error_log($e);
          }
                              
          foreach ($applications as $application) {
            if ($application['application_id'] == '137801623089103') {
              $admin = TRUE;
              break;
            }
          }
                              
          if ($admin) {
          
            $signups = $contact_repository->findBy(
                array(),
                array('created' => 'DESC')
            );
            
          }
          
        }
        else {       
          $login_url = $facebook->getLoginUrl(array('scope' => 'email'));
        }
        
        $params = array(
          'user' => $facebook_user,
          'contact' => $contact,
          'admin' => $admin,
          'signups' => $signups,
          'login_url' => $login_url,
          'logout_url' => $logout_url,
        );
        
        return $this->render('ShesTheFirstSignUpBundle:Default:index.html.twig', $params);
    }
    
    public function logoutAction()
    {
        
        $facebook = new \Facebook(array(
          'appId'  => $this->container->getParameter('shes_the_first_sign_up.facebook.app_id'),
          'secret' => $this->container->getParameter('shes_the_first_sign_up.facebook.secret'),
        ));
        
        $facebook->destroySession();
        
        return $this->redirect($this->generateUrl('shes_the_first_sign_up_homepage'));
      
    }
    
}
