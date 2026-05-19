<?php

declare(strict_types=1);

namespace App\Controllers\Super\Validator;

use App\Core\Template;
use App\Utils\{Entities\CorrectionUtils, GeneralUtils};

class RejectCorrectionController
{
    public function handle(Template $template): void
    {
        if (!isset($_GET['id'])) {
            GeneralUtils::showAlert('No se especificó la corrección.');
            exit;
        }

        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eliminar corrección
            $success = CorrectionUtils::delete($id);
            if ($success) {
                // Redirigir
                header('Location: correction_validation.php');
            }

            exit;
        }

        // Obtener corrección
        $correction = CorrectionUtils::get($id);
        if (!$correction) {
            exit;
        }

        if ($correction['is_approved']) {
            GeneralUtils::showAlert('La corrección ya se encuentra aprobada.');
            exit;
        }

        $template->apply(['correction' => $correction]);
    }
}
