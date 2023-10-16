<?php

if (!defined('TYPO3')) {
  die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
  'MailjetApi',
  'Subscription',
  [
    \Passionweb\MailjetApi\Controller\FormController::class => 'form,subscribe,',
  ],
  [
    \Passionweb\MailjetApi\Controller\FormController::class => 'form,subscribe,',
  ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MailjetApi',
    'VerifySubscription',
    [
        \Passionweb\MailjetApi\Controller\FormController::class => 'verify,',
    ],
    [
        \Passionweb\MailjetApi\Controller\FormController::class => 'verify,',
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
'mod {
        wizards.newContentElement.wizardItems.plugins {
            elements {
                subscription {
                    iconIdentifier = mailjet-api-wizard-icon
                    title = LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:plugin_mailjet_api_subscription.name
                    description = LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:plugin_mailjet_api_subscription.description
                    tt_content_defValues {
                        CType = list
                        list_type = mailjetapi_subscription
                    }
                }
                verifysubscription {
                    iconIdentifier = mailjet-api-wizard-icon
                    title = LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:plugin_mailjet_api_verifysubscription.name
                    description = LLL:EXT:mailjet_api/Resources/Private/Language/locallang_db.xlf:plugin_mailjet_api_verifysubscription.description
                    tt_content_defValues {
                        CType = list
                        list_type = mailjetapi_verifysubscription
                    }
                }
            }
            show = *
        }
   }'
);

/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
  'mailjet-api-wizard-icon',
  \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
  ['source' => 'EXT:mailjet_api/Resources/Public/Icons/Extension.png']
);
