<?php

namespace App\Controller;

use Ludens\Exceptions\Authentication\BadCredentialsException;
use Ludens\Exceptions\Authentication\UserNotFoundException;
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
        } catch (UserNotFoundException $e) {
            $this->error($e->getMessage());
            $this->flash($request->all());
            return $this->redirect('/login');
        } catch (BadCredentialsException $e) {
            $this->error($e->getMessage());
            $this->flash($request->all());
            return $this->redirect('/login');
        }
    }
}
