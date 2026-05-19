<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Template;

class LogoutController
{
    public function handle(Template $template): void
    {
        global $google_client;

        // Cerrar sesión y redirigir al login
        $google_client->revokeToken();
        session_destroy();
        header('location: /auth/login.php');
    }
}
