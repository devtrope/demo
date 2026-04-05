<?php

namespace App\Controller;

use Ludens\Exceptions\Authentication\AuthenticationException;
use Ludens\Http\Request;
use Ludens\Http\Response;

class LoginController extends BaseController
{
    public function index(): Response
    {
        return $this->view('login/index.html.twig');
    }

    public function postIndex(Request $request): Response
    {
        try {
            return $this->authenticator($request)->authenticate();
        } catch (AuthenticationException $e) {
            return $this->redirect('/login', [
                'error' => $e->getMessage(),
                'old' => $request->all()
            ]);
        }
    }
}
