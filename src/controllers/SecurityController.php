<?php


require_once 'AppController.php';


require_once __DIR__ . '/../models/User.php';
require_once(__DIR__ . '/../repository/UserRepository.php');
require_once __DIR__ . '/../helpers/LoginMenager.php';

class SecurityController extends AppController
{

    public function login()
    {

        LoginMenager::redirectIfLoggedIn();
        if (!$this->isPost())
            return $this->render('login');

        if (($_POST['login']) === "")
            return $this->render('login', ['title' => 'Strona główna', 'styles' => ['loggedOutStyle', 'style']]);

        if ($_POST['password'] === "")
            return $this->render('login', ['title' => 'Strona główna', 'styles' => ['loggedOutStyle', 'style']]);


        $userRepository = new UserRepository();
        $user = $userRepository->getUser($_POST['login'], $_POST['password']);

        if (!$user)
            return $this->render('login', ['title' => 'Strona główna', 'styles' => ['loggedOutStyle', 'style']]);


        $_SESSION['user'] = $user->getUsername();

        if ($user->getAccountType() === "user") {

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/mojeZaklady");
        } else if ($user->getAccountType() === 'admin') {

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/zarzadzajZakladami");
        }


    }

    public function logout()
    {
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");

    }


    public function registerBG()
    {

        $repo = new UserRepository();
        if (!$this->isPost())
            return $this->render('login');


        $login = $_POST['login'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        $user = new User($login, md5($password), $username, $email, 'user');

        $repo->register($user);
        $_SESSION['user'] = $user->getUsername();


        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/mojeZaklady");


    }


    public function isLoginAvailable()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            $repo = new UserRepository();
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($repo->isLoginAvailable($decoded['login']));
        }
    }

    public function isEmailAvailable()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            $repo = new UserRepository();
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($repo->isEmailAvailable($decoded['email']));
        }
    }

}