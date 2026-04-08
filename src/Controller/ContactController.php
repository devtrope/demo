<?php

namespace App\Controller;

use Ludens\Http\Request;
use Ludens\Http\Response;
use Ludens\Validation\Rules\Required;

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
        return $this->redirect('/', ['success' => 'Votre message a bien été envoyé']);
    }
}
