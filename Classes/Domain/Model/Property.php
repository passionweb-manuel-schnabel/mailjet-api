<?php

namespace Passionweb\MailjetApi\Domain\Model;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Property extends AbstractEntity
{
    protected string $formPropertyName = '';

    protected string $mailjetPropertyName = '';

    protected string $formPropertyType = '';

    protected string $formPropertyPlaceholder = '';

    protected bool $formPropertyRequired = false;

    protected bool $useForMailjetEmail = false;

    protected bool $useForMailjetName = false;

    public function getFormPropertyName(): string
    {
        return $this->formPropertyName;
    }

    public function setFormPropertyName(string $formPropertyName): void
    {
        $this->formPropertyName = $formPropertyName;
    }

    public function getMailjetPropertyName(): string
    {
        return $this->mailjetPropertyName;
    }

    public function setMailjetPropertyName(string $mailjetPropertyName): void
    {
        $this->mailjetPropertyName = $mailjetPropertyName;
    }

    public function getFormPropertyType(): string
    {
        return $this->formPropertyType;
    }

    public function setFormPropertyType(string $formPropertyType): void
    {
        $this->formPropertyType = $formPropertyType;
    }

    public function getFormPropertyPlaceholder(): string
    {
        return $this->formPropertyPlaceholder;
    }

    public function setFormPropertyPlaceholder(string $formPropertyPlaceholder): void
    {
        $this->formPropertyPlaceholder = $formPropertyPlaceholder;
    }

    public function isFormPropertyRequired(): bool
    {
        return $this->formPropertyRequired;
    }

    public function setFormPropertyRequired(bool $formPropertyRequired): void
    {
        $this->formPropertyRequired = $formPropertyRequired;
    }

    public function isUseForMailjetEmail(): bool
    {
        return $this->useForMailjetEmail;
    }

    public function setUseForMailjetEmail(bool $useForMailjetEmail): void
    {
        $this->useForMailjetEmail = $useForMailjetEmail;
    }

    public function isUseForMailjetName(): bool
    {
        return $this->useForMailjetName;
    }

    public function setUseForMailjetName(bool $useForMailjetName): void
    {
        $this->useForMailjetName = $useForMailjetName;
    }

}
