<?php

function checkRole($roleName)
{
    $roles = Auth::user()->userRoles;
    foreach ($roles as $role) {
        $userRoles[] = $role->role->name;
    }
    return in_array($roleName, $userRoles);
}
