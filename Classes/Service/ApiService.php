<?php

namespace Passionweb\MailjetApi\Service;

use Mailjet\Client;
use Mailjet\Resources;
use Passionweb\MailjetApi\Domain\Model\Subscription;
use Passionweb\MailjetApi\Domain\Repository\PropertyRepository;
use Passionweb\MailjetApi\Domain\Repository\SubscriptionRepository;
use Passionweb\MailjetApi\Exception\ContactdataNotFoundException;
use Passionweb\MailjetApi\Exception\ContactlistNotFoundException;
use Psr\Log\LoggerInterface;
use Exception;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class ApiService {

    protected SubscriptionRepository $subscriptionRepository;
    protected PropertyRepository $propertyRepository;
    protected PersistenceManager $persistenceManager;

    protected Client $client;

    protected LoggerInterface $logger;


    public function __construct(
        PropertyRepository $propertyRepository,
        SubscriptionRepository $subscriptionRepository,
        PersistenceManager $persistenceManager,
        Client $client,
        LoggerInterface $logger
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->propertyRepository = $propertyRepository;
        $this->persistenceManager = $persistenceManager;
        $this->client = $client;
        $this->logger = $logger;
    }

    public function subscribe(array $formData, array $flexFormSettings) {
        $propertyMail = $this->propertyRepository->findByUid($flexFormSettings['propertyMail']);
        $receiverPorperties = explode(',', $flexFormSettings['propertiesReceiver']);
        $receiverName = '';
        foreach($receiverPorperties as $receiverPorperty) {
            $property = $this->propertyRepository->findByUid($receiverPorperty);
            $receiverName .= $formData[$property->getFormPropertyName()] . ' ';
        }
        $contactId = $this->manageContact(trim($receiverName), trim($formData[$propertyMail->getFormPropertyName()]), $formData, (int)$flexFormSettings['mailjetListID'], $flexFormSettings);
        if($contactId > 0) {
            $subscription = new Subscription();
            $subscription->setPid((int)$flexFormSettings['storagePid']);
            $subscription->setContactId($contactId);
            $subscription->setEmail($formData[$propertyMail->getFormPropertyName()]);
            $subscription->setReceiverName(trim($receiverName));
            $this->subscriptionRepository->add($subscription);
            $this->persistenceManager->persistAll();
            $this->sendSubscribeMail(trim($receiverName), trim($formData[$propertyMail->getFormPropertyName()]), $contactId, $flexFormSettings);
        }
    }

    public function verify(int $contactId, array $flexFormSettings): void
    {
        try {
            $body = [
                'ContactsLists' => [
                    [
                        'Action' => "addforce",
                        'ListID' => (int)$flexFormSettings['mailjetListID']
                    ],
                ]
            ];
            $resContactManagecontactslists = $this->client->post(Resources::$ContactManagecontactslists, ['id' => $contactId, 'body' => $body]);
            if(!$resContactManagecontactslists->success()) {
                throw new ContactlistNotFoundException('Subscription could not be verified.');
            }
            $resContactdata = $this->client->get(Resources::$Contact, ['id' => $contactId]);
            if(!$resContactdata->success() || count($resContactdata->getBody()['Data']) === 0 || count($resContactdata->getBody()['Data']['0']) === 0) {
                throw new ContactdataNotFoundException('Contact data could not be fetched.');
            }
            $this->sendSubscribeSuccessMail($contactId, $flexFormSettings);
        } catch(Exception $e) {
            $this->logger->error($e->getMessage(), [
                'contactId' => $contactId,
            ]);
        }
    }

    private function manageContact(string $receiverName, string $receiverEmail, array $formData, int $mailjetListId, array $flexFormSettings): int
    {
        try {
            $properties = [];
            foreach ($formData as $key => $value) {
                $property = $this->propertyRepository->findOneByFormPropertyName($key);
                if($property !== null && !$property->isUseForMailjetEmail()) {
                    $properties[$property->getMailjetPropertyName()] = trim($value);
                }
            }
            $body = [
                'Name' => $receiverName,
                'Properties' => $properties,
                'Action' => "Unsub",
                'Email' => $receiverEmail
            ];
            $response = $this->client->post(Resources::$ContactslistManagecontact, ['id' => $mailjetListId, 'body' => $body]);
            if($response->success() && count($response->getBody()['Data']) > 0) {
                return $response->getBody()['Data'][0]['ContactID'];
            } else {
                throw new Exception($response->getStatus());
            }
        } catch(Exception $e) {
            $this->logger->error($e->getMessage());
            return 0;
        }
    }

    private function sendSubscribeSuccessMail(int $contactId, array $flexFormSettings): void
    {
        $subscription = $this->subscriptionRepository->findOneByContactId($contactId);
        try {
            $body = [
                'Messages' => [
                    [
                        'FromEmail' => $flexFormSettings['subscribeSuccessFromEmail'],
                        'FromName' => $flexFormSettings['subscribeSuccessFromName'],
                        'Subject' => $flexFormSettings['subscribeSuccessSubject'],
                        'MJ-TemplateID' => (int)$flexFormSettings['subscribeSuccessMJTemplateID'],
                        'MJ-TemplateLanguage' => true,
                        'Vars' => [
                            'contactId' => $contactId
                        ],
                        'Recipients' => [
                            [
                                'Email' => $subscription->getEmail(),
                                'Name' => $subscription->getReceiverName()
                            ]
                        ],
                    ]
                ]
            ];
            $mailSent = $this->client->post(Resources::$Email, ['body' => $body]);
            if(!$mailSent->success()) {
                throw new Exception('Verification success mail could not be sent (Status-Code: ' . $mailSent->getStatus() . ')');
            }
        } catch(Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
    private function sendSubscribeMail(string $receiverName, string $receiverEmail, int $contactId, array $flexFormSettings): void
    {
        try {
            $body = [
                'Messages' => [
                    [
                        'FromEmail' => $flexFormSettings['subscribeFromEmail'],
                        'FromName' => $flexFormSettings['subscribeFromName'],
                        'Subject' => $flexFormSettings['subscribeSubject'],
                        'MJ-TemplateID' => (int)$flexFormSettings['subscribeMJTemplateID'],
                        'MJ-TemplateLanguage' => true,
                        'Vars' => [
                            'contactId' => $contactId
                        ],
                        'Recipients' => [
                            [
                                'Email' => $receiverEmail,
                                'Name' => $receiverName
                            ]
                        ],
                    ]
                ]
            ];
            $mailSent = $this->client->post(Resources::$Email, ['body' => $body]);
            if(!$mailSent->success()) {
                throw new Exception('Subscription mail could not be sent (Status-Code: ' . $mailSent->getStatus() . ')');
            }
        } catch(Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    private function retrieveContactData($resBody): array
    {
        $contactData = [];
        foreach ($resBody['Data']['0']['Data'] as $value) {
            $contactData[$value['Name']] = $value['Value'];
        }
        return $contactData;
    }
}
