<?php

namespace App\Http\Controller;

use App\Http\Repository\UserRepository;
use Ludens\Http\Request;
use Ludens\Http\Response;

class LoginController extends BaseController
{
    public function __construct(
        private UserRepository $userRepository
    ) {
        parent::__construct();
    }

    public function index(): Response
    {
        return $this->view('login/index.html.twig');
    }

    public function postIndex(Request $request): Response
    {
        $user = $this->userRepository->findBy('username', $request->data('username'));
        if (null === $user) {
            $this->error('Aucun utilisateur avec ce nom d\'utilisateur');
            return $this->redirect('/login');
        }
        $this->auth($user);
        return $this->redirect('/');
    }
}
