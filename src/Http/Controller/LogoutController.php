<?php

namespace App\Http\Controller;

use Ludens\Http\Response;

class LogoutController extends BaseController
{
    public function postIndex(): Response
    {
        return $this->logout();
    }
}
