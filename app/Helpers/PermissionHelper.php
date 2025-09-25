<?php

namespace App\Helpers;

class PermissionHelper
{
    // Define permissions for each role as an array
    public static $rolePermissions = [
        'Super Admin' => [
            'view company',
            'create company',
            'edit company',
            'delete company',
            'view employee',
            'create employee',
            'edit employee',
            'delete employee',
            'view profile',
            'change password',
            'manage roles',
        ],
        'Manager' => [
            'view company',
            'create company',
            'edit company',
            'view employee',
            'create employee',
            'edit employee',
            'manage roles',
        ],
        'Employee' => [
            'view profile',
            'change password',
        ],
    ];

    // Check if a user is permitted to do an action based on their role
    public static function isUserPermittedTo($user, $permission)
    {
        $roles = method_exists($user, 'getRoleNames') ? $user->getRoleNames()->toArray() : [];
        foreach ($roles as $role) {
            if (isset(self::$rolePermissions[$role]) && in_array($permission, self::$rolePermissions[$role])) {
                return true;
            }
        }
        return false;
    }
}
