<?php

declare(strict_types=1);

namespace App\Controllers\Super\Validator;

use App\Core\Template;
use App\Utils\Entities\CorrectionUtils;

class CorrectionValidationController
{
    public function handle(Template $template): void
    {
        $template->apply([
            'corrections' => CorrectionUtils::getAllPending(),
        ]);
    }
}
