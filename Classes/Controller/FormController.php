<?php

namespace Passionweb\MailjetApi\Controller;

use Passionweb\MailjetApi\Domain\Model\Property;
use Passionweb\MailjetApi\Domain\Repository\PropertyRepository;
use Passionweb\MailjetApi\Service\SecureCheckService;
use Passionweb\MailjetApi\Service\ApiService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


class FormController extends ActionController {

    protected ApiService $apiService;
    protected SecureCheckService $secureCheckService;

    protected PropertyRepository $propertyRepository;

    public function __construct(
        ApiService $apiService,
        SecureCheckService $secureCheckService,
        PropertyRepository $propertyRepository
    ) {
        $this->apiService = $apiService;
        $this->secureCheckService = $secureCheckService;
        $this->propertyRepository = $propertyRepository;
    }

    public function formAction(): ResponseInterface {
        $queryParams = $this->request->getQueryParams();
        if(array_key_exists('tx_mailjet_api_subscription', $queryParams)
            && array_key_exists('noValidForm', $queryParams['tx_mailjet_api_subscription'])
            && (int)$queryParams['tx_mailjet_api_subscription']['noValidForm'] === 1) {
            $this->view->assign('noValidFormMessage', 1);
        }
        $propertyIds = explode(',', $this->settings['properties']);
        $formProperties = [];
        foreach ($propertyIds as $propertyId) {
            /** @var Property $property */
            $property = $this->propertyRepository->findByUid($propertyId);
            $formProperties[$property->getFormPropertyName()] = [
                'type' => $property->getFormPropertyType(),
                'placeholder' => $property->getFormPropertyPlaceholder(),
                'required' => $property->isFormPropertyRequired(),
                'mailjet_property_name' => $property->getMailjetPropertyName(),
                'useForMailjetEmail' => $property->isUseForMailjetEmail(),
                'useForMailjetName' => $property->isUseForMailjetName()
            ];
        }
        $this->view->assign('formProperties', $formProperties);
        return $this->htmlResponse();
    }

    public function subscribeAction(): ResponseInterface
    {
        $subscriptionData = $this->request->getArgument('subscription');
        if(!is_array($subscriptionData) || !array_key_exists('security-check', $subscriptionData)) {
            return $this->redirect('form', 'Form', 'mailjet_api', ['noValidForm' => 1]);
        }
        $securityChecks = json_decode($subscriptionData['security-check'], true);
        $valid = $this->secureCheckService->isValid($securityChecks);
        if(!$valid) {
            return $this->redirect('form', 'Form', 'mailjet_api', ['noValidForm' => 1]);
        }
        $this->apiService->subscribe($subscriptionData, $this->settings);

        $uri = $this->uriBuilder
            ->setTargetPageUid((int)$this->settings['redirectToPagePid'])
            ->buildFrontendUri();

        return $this->redirectToUri($uri);
    }

    public function verifyAction(): ResponseInterface
    {
        if(!empty($_GET['contact_id'])) {
            $contactId = (int) $_GET['contact_id'];
            $this->apiService->verify($contactId, $this->settings);
        }
        return $this->htmlResponse();
    }
}
