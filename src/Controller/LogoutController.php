<?php

namespace App\Controller;

use Ludens\Http\Response;

class LogoutController extends BaseController
{
    public function postIndex(): Response
    {
        return $this->logout();
    }
}
