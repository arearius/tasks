<?php


class Config
{
    public static $db = [
        'host' => 'localhost:3306',
        'user' => 'tasks',
        'password' => 'Tasks123@',
        'db_name' => 'tasks',
        'tables' => ['tasks', 'auth']
    ];

    public static $tablesStructure = [
        'tasks' => [
            'fields' => [
                'id' => 'INT(16) NOT NULL AUTO_INCREMENT',
                'create_date' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'user_name' => 'varchar(40) COLLATE utf8_bin NOT NULL',
                'mail' => 'varchar(40) COLLATE utf8_bin NOT NULL',
                'text' => 'varchar(120) COLLATE utf8_bin NOT NULL',
		        'status' => 'tinyint(1) DEFAULT NULL',
                'modified' => 'tinyint(1) DEFAULT NULL'
            ],
            'primaryKey' => 'id'
        ],
	'auth' => [
	    'fields' => [
		'session' => 'varchar(40) COLLATE utf8_bin NOT NULL, '
	    ],
	    'primaryKey' => 'session'
	]
    ];

    public static $users = [
	'admin' => '123'
    ];

    public static $lang = [
	"ru" => [
	    "defaultview" => [
		"selected_language_en" => "English_ru",
		"selected_language_ru" => "Russian_ru",
		"register_form" => [
		    "nikname_label" => "input your nikname rus",
		    "nikname_invalid_message" => "nikname must be valid rus"
		]
	    ]
	],
	"en" => [
	    "defaultview" => [
		"selected_language_en" => "English",
		"selected_language_ru" => "Russian",
		"register_form" => [
		    "nikname_label" => "input your nikname",
		    "nikname_invalid_message" => "nikname must be valid"
		]

	    ]
	]
    ];
}