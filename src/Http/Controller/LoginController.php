<?php

namespace App\Http\Controller;

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
        return $this->authenticate($request);
    }
}
