<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Template;
use App\Utils\{Entities\IncidenceUtils, PrintUtils};

class HomeController
{
    public function handle(Template $template): void
    {
        $yesterday = time() - (24 * 60 * 60);
        $incidents = IncidenceUtils::getAllApproved();
        $pendingIncidents = IncidenceUtils::getAllPending();
        $recentIncidents = array_filter($incidents, static fn ($item) => strtotime($item['creation_date']) >= $yesterday);

        $lastIncidence = array_reduce($recentIncidents, static function ($carry, $item) {
            if ($carry === null) {
                return $item;
            }
            return strtotime($item['creation_date']) > strtotime($carry['creation_date'])
                ? $item
                : $carry;
        });

        $template->apply([
            'incidentsCount' => \count($incidents),
            'pendingIncidentsCount' => \count($pendingIncidents),
            'recentIncidentsCount' => \count($recentIncidents),
            'lastIncidenceDate' => PrintUtils::getPrintableDate($lastIncidence['creation_date'] ?? ''),
        ]);
    }
}
