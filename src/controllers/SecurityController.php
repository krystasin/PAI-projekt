<?php




require_once 'AppController.php';



require_once __DIR__ .'/../models/User.php';
require_once ( __DIR__ . '/../repository/UserRepository.php' );

class SecurityController extends AppController
{

    public function login(){
        if(!$this->isPost())
            return $this->render('login');

        if(($_POST['login']) === null) return $this->render('login', [ 'messages' => ['nie podano loginu']]);
        if($_POST['password'] === null)  return $this->render('login', [ 'messages' => ['nie podano hasła']]);

        $userRepository = new UserRepository();
        $user = $userRepository->getUser( $_POST['login'], $_POST['password']);

        if(!$user)
            return $this->render('login', [ 'messages' => ['niepoprawny login lub hasło']]);


        $_SESSION['user'] = $user->getUsername();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");

       // return $this->render('main');
    }

    public function logout(){
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");

    }
}