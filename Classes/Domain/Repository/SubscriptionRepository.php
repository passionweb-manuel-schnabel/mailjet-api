<?php

namespace Passionweb\MailjetApi\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class SubscriptionRepository extends Repository
{
    protected $defaultOrderings = array(
        'crdate' => QueryInterface::ORDER_DESCENDING
    );

    public function initializeObject()
    {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }
}
