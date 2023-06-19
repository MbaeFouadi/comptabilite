<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'Superadministrateur' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'Caissier' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'Gestionnaire' => [
            'profile' => 'r,u',
        ],
        'Chargé des recettes' => [
            'profile' => 'r,u',
        ],

        'Chargé du budget' => [
            'profile' => 'r,u',
        ],

        'Contrôleur financier' => [
            'profile' => 'r,u',
        ],

        'Agent Comptable' => [
            'profile' => 'r,u',
        ],

        'Président' => [
            'profile' => 'r,u',
        ],

        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
