<?php

namespace App\Controller;

use Ludens\Http\Request;
use Ludens\Http\Response;
use Ludens\Validation\Required;

class ContactController extends BaseController
{
    public function index(): Response
    {
        return $this->view('contact/index.html.twig');
    }

    public function postIndex(Request $request): Response
    {
        $request->validate([
            'mail' => [new Required()]
        ]);
        
        $this->success('Votre message a bien été envoyé');
        return $this->redirect('/');
    }
}
