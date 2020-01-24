<?php

$hierarchy[] = [
    'role_name' => "CEO",
    'subordinates' => [
        [
            'role_name' => 'Commercial Director',
            'subordinates' => [
                [
                    'role_name' => 'Sales Manager',
                    'subordinates' => [
                        [
                            'role_name' => 'Salesman',
                            'subordinates' => []
                        ],

                    ]
                ],
            ]
        ],
        [
            'role_name' => 'Financial Director',
            'subordinates' => [
                [
                    'role_name' => 'Account Manager',
                    'subordinates' => [
                        [
                            'role_name' => 'Businessman',
                            'subordinates' => []
                        ],
                    ]
                ],
            ]
        ]
    ]
];

function showRoles(array $roles): String
{

    $html = "<ul>";

    foreach ($roles as $role) {
        $html .= "<li>";
        $html .= $role['role_name'];

        if (isset($role['subordinates']) && count($role['subordinates']) > 0 ) {
            $html .= showRoles($role['subordinates']);
        }

        $html .= "</li>";
    }

    $html .= "</ul>";

    return $html;
}

echo showRoles($hierarchy);



