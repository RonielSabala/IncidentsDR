<?php

declare(strict_types=1);

namespace App\Controllers\Super\Validator;

use App\Core\Template;
use App\Utils\Entities\{CorrectionUtils, IncidenceUtils};

class HomeController
{
    public function handle(Template $template): void
    {
        $template->apply([
            'pending_incidents_count' => \count(IncidenceUtils::getAllPending()),
            'pending_corrections_count' => \count(CorrectionUtils::getAllPending()),
        ]);
    }
}
