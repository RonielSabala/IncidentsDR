<?php

declare(strict_types=1);

namespace App\Controllers\Super\Admin;

use App\Core\Template;
use App\Utils\Entities\{RoleUtils, UserUtils};

class UserController
{
    public function handle(Template $template): void
    {
        $userId = null;
        $roleId = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $roleId = $_POST['role_id'];
            RoleUtils::clearUserRoles($userId);
            RoleUtils::assignUserRole($userId, $roleId);
        }

        $session_user_id = $_SESSION['user']['id'];
        $allUsers = UserUtils::getAll();
        $filteredUsers = array_values(array_filter($allUsers, static fn ($u) => $u['id'] !== $session_user_id));

        $template->apply([
            'users' => $filteredUsers,
            'roles' => RoleUtils::getAll(),
            'default_user' => $userId,
            'default_role' => $roleId,
        ]);
    }
}
