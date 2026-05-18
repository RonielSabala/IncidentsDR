<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Template;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use App\Utils\{GeneralUtils, OAuthUtils};

class MicrosoftCallbackController
{
    public function handle(Template $template): void
    {
        $oauthClient = OAuthUtils::getMicrosoftClient();

        // Validar código
        if (!isset($_GET['code'])) {
            GeneralUtils::showAlert('Código de autorización no encontrado.');
            exit;
        }

        // Validar estado
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            GeneralUtils::showAlert('El estado no es válido o ha expirado.');

            // Limpiar sesión
            session_unset();
            exit;
        }

        try {
            // Obtener los datos del usuario
            $accessToken = $oauthClient->getAccessToken('authorization_code', [
                'code' => $_GET['code'],
            ]);

            $request = $oauthClient->getAuthenticatedRequest(
                'GET',
                'https://graph.microsoft.com/v1.0/me',
                $accessToken
            );

            $response = $oauthClient->getResponse($request);
            $userMetadata = json_decode((string) $response->getBody(), true);

            // Guardar sesión y hacer login
            $_SESSION['user'] = [
                'username' => $userMetadata['displayName'],
                'email' => $userMetadata['userPrincipalName'],
            ];

            LoginController::logUser();
        } catch (IdentityProviderException $e) {
            GeneralUtils::showAlert('Error al obtener token: ' . $e->getMessage());
        }
    }
}
