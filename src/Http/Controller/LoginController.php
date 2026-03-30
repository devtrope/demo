<?php

namespace App\Http\Controller;

use Exception;
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
            return $this->authenticate($request);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            $this->flash($request->all());
            return $this->redirect('/login');
        }
    }
}
