<?php
defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MailjetApi',
    'Subscription',
    'Mailjet Subscription'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['mailjetapi_subscription'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'mailjetapi_subscription',
    'FILE:EXT:mailjet_api/Configuration/FlexForms/flexform_mailjet_subscribe.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MailjetApi',
    'VerifySubscription',
    'Mailjet Verify Subscription'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['mailjetapi_verifysubscription'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'mailjetapi_verifysubscription',
    'FILE:EXT:mailjet_api/Configuration/FlexForms/flexform_mailjet_verify.xml'
);
