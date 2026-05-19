<?php

declare(strict_types=1);

namespace App\Controllers\Incidents;

use App\Core\Template;
use App\Utils\{
    Entities\CommentUtils,
    Entities\IncidenceUtils,
    Entities\LabelUtils,
    GeneralUtils
};

class IncidenceController
{
    public function handle(Template $template): void
    {
        if (!isset($_GET['id'])) {
            GeneralUtils::showAlert('No se especificó la incidencia.');
            exit;
        }

        // Obtener incidencia
        $incidence_id = $_GET['id'];
        $incidence = IncidenceUtils::get($incidence_id);
        if (!$incidence) {
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_GET['action'];

            if ($action === 'POST') {
                $user_id = $_SESSION['user']['id'];
                $comment_text = trim($_POST['comment_text']);
                CommentUtils::create($comment_text, $user_id, $incidence_id);
            } elseif ($action === 'DELETE') {
                $comment_id = $_POST['comment_id'];
                CommentUtils::delete($comment_id);
            }
        }

        $labels = LabelUtils::getAllByIncidenceId($incidence_id);
        $comments = CommentUtils::getAllByIncidenceId($incidence_id);
        $template->apply([
            'incidence' => $incidence,
            'labels' => $labels,
            'comments' => $comments,
        ]);
    }
}
