<?php

declare(strict_types=1);

namespace App\Controllers\Super\Validator;

use App\Core\Template;
use App\Utils\{Entities\CorrectionUtils, GeneralUtils};

class ApproveCorrectionController
{
    public function handle(Template $template): void
    {
        if (!isset($_GET['id'])) {
            GeneralUtils::showAlert('No se especificó la corrección.');
            exit;
        }

        // Obtener corrección
        $id = $_GET['id'];
        $correction = CorrectionUtils::get($id);
        if (!$correction) {
            exit;
        }

        if ($correction['is_approved']) {
            GeneralUtils::showAlert('La corrección ya se encuentra aprobada.');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Aprobar y aplicar corrección
            if (CorrectionUtils::setApproval($id) && CorrectionUtils::apply($correction)) {
                // Redirigir
                header('Location: correction_validation.php');
            }

            exit;
        }

        $template->apply(['correction' => $correction]);
    }
}
