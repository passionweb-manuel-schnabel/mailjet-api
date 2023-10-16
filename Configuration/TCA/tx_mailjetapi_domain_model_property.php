<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property',
        'label' => 'form_property_name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'status,tablenames,fieldname,sys_file_uid',
        'iconfile' => 'EXT:mailjet_api/Resources/Public/Icons/Extension.png'
    ],
    'types' => [
        '1' => ['showitem' => 'form_property_name, mailjet_property_name, form_property_type, form_property_placeholder, form_property_required, use_for_mailjet_name, use_for_mailjet_email, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden,'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_mailjetapi_domain_model_property',
                'foreign_table_where' => 'AND {#tx_mailjetapi_domain_model_property}.{#pid}=###CURRENT_PID### AND {#tx_mailjetapi_domain_model_property}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'form_property_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.form_property_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'mailjet_property_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.mailjet_property_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'form_property_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.form_property_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['text', 'text'],
                    ['email', 'email'],
                    ['tel', 'tel'],
                    ['number', 'number'],
                    ['url', 'url'],
                ],
            ],
        ],
        'form_property_placeholder' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.form_property_placeholder',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'form_property_required' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.form_property_required',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0
            ],
        ],
        'use_for_mailjet_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.use_for_mailjet_name',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0
            ],
        ],
        'use_for_mailjet_email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:tx_mailjetapi_domain_model_property.use_for_mailjet_email',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0
            ],
        ],
    ],
];
