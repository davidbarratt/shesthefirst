<?php

namespace ShesTheFirst\SignUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
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
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            print '<pre>'.print_r($facebook->api('/268106193299574/likes'), TRUE).'</pre>';
          } catch (FacebookApiException $e) {
            print $e->getMessage();
          }
        }
                
        // print '<pre>'.print_r($facebook->getAccessToken(), TRUE).'</pre>';
        
        print '<pre>'.print_r($user, TRUE).'</pre>';
        
        print '<pre>'.print_r($facebook->getLoginUrl(array('scope' => 'email')), TRUE).'</pre>';
        
        return $this->render('ShesTheFirstSignUpBundle:Default:index.html.twig');
    }
}
