<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Template;
use App\Utils\{GeneralUtils, OAuthUtils};

class SigninController
{
    public function handle(Template $template): void
    {
        // Crear usuario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = LoginController::logUser();
            if (\is_string($response) && !empty($response)) {
                $template->apply();
                GeneralUtils::showAlert($response, showReturn: false);
            }

            exit;
        }

        $template->apply([
            'google_auth_url' => OAuthUtils::getGoogleUrl(),
        ]);
    }
}
