<?php

namespace Passionweb\MailjetApi\Domain\Model;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Subscription extends AbstractEntity
{
    protected int $contactId = 0;

    protected string $email = '';

    protected string $receiverName = '';

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $contactId): void
    {
        $this->contactId = $contactId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    public function setReceiverName(string $receiverName): void
    {
        $this->receiverName = $receiverName;
    }
}
