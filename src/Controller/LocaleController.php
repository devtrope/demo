<?php

namespace App\Controller;

use Ludens\Http\Request;
use Ludens\Http\Response;

class LocaleController extends BaseController
{
    public function postIndex(Request $request): Response
    {
        $this->setLocale($request->data('locale'));
        return $this->json(['success' => true]);
    }
}
