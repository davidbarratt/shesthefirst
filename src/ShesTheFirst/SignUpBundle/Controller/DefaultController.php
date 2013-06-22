<?php

namespace ShesTheFirst\SignUpBundle\Controller;

use ShesTheFirst\SignUpBundle\Entity\Facebook;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        $login_url = NULL;
        $logout_url = NULL;
        $facebook_user = NULL;
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
        
          $repository = $this->getDoctrine()->getRepository('ShesTheFirstSignUpBundle:Facebook');
        
          $facebook_user = $repository->find($user);
              
          if (!$facebook_user) {
          
            $facebook_user = new Facebook();
            $facebook_user->setId($user);
            
            $created = new \DateTime('now', new \DateTimeZone('UTC'));
          
            $facebook_user->setCreated($created);
            
          }
          
          $facebook_user->setUsername($user_profile['username']);
          $facebook_user->setFirstName($user_profile['first_name']);
          $facebook_user->setLastName($user_profile['last_name']);
          $facebook_user->setEmail($user_profile['email']);
          
          $updated = new \DateTime('now', new \DateTimeZone('UTC'));
          
          $facebook_user->setUpdated($updated);
          
          $facebook_user->setAccessToken($facebook->getAccessToken());
      
          $em = $this->getDoctrine()->getManager();
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
            $signups = $repository->findBy(
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
