<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Template;
use App\Utils\OAuthUtils;

class MicrosoftController
{
    public function handle(Template $template): void
    {
        $oauthClient = OAuthUtils::getMicrosoftClient();
        $authorizationUrl = $oauthClient->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $oauthClient->getState();
        header('Location: ' . $authorizationUrl);
        exit;
    }
}
