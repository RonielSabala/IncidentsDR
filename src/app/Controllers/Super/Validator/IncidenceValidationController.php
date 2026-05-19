<?php

declare(strict_types=1);

namespace App\Controllers\Super\Validator;

use App\Core\Template;
use App\Utils\Entities\IncidenceUtils;

class IncidenceValidationController
{
    public function handle(Template $template): void
    {
        $template->apply([
            'incidents' => IncidenceUtils::getAllPending(),
        ]);
    }
}
