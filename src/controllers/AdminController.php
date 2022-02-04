<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once __DIR__ . '/../repository/AdminRepository.php';


class AdminController extends AppController
{
    private AdminRepository $repo;


    public function __construct()
    {
        parent::__construct();
        $this->repo = new AdminRepository();
    }
    public function zarzadzajZakladami()
    {
        $zaklady = $this->repo->getAllZaklady();
        $this->render('admin/zarzadzajZakladami', ['title' => 'Strona główna','zaklady' => $zaklady ]);
    }


}