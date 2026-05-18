<?php

declare(strict_types=1);

namespace App\Controllers\Super\Admin;

use App\Core\Template;
use App\Utils\Entities\{
    LabelUtils,
    MunicipalityUtils,
    NeighborhoodUtils,
    ProvinceUtils,
    RoleUtils,
    UserUtils
};

class HomeController
{
    public function handle(Template $template): void
    {
        $template->apply([
            'users_count' => \count(UserUtils::getAll()),
            'roles_count' => \count(RoleUtils::getAll()),
            'provinces_count' => \count(ProvinceUtils::getAll()),
            'municipalities_count' => \count(MunicipalityUtils::getAll()),
            'neighborhoods_count' => \count(NeighborhoodUtils::getAll()),
            'labels_count' => \count(LabelUtils::getAll()),
        ]);
    }
}
