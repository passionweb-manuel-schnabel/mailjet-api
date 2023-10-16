<?php

use Mailjet\Client;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use Passionweb\MailjetApi\Service\ApiService;
use Passionweb\MailjetApi\Factory\MailjetClientFactory;
use Passionweb\MailjetApi\Service\SecureCheckService;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void {
    $services = $containerConfigurator->services();
    $services->defaults()
        ->private()
        ->autowire()
        ->autoconfigure();

    $services->load('Passionweb\\MailjetApi\\', __DIR__ . '/../Classes/')
        ->exclude([
            __DIR__ . '/../Classes/Domain/Model',
        ]);

    $services->set('ExtConf.mailjet', 'array')
        ->factory([service(ExtensionConfiguration::class), 'get'])
        ->args([
            'mailjet_api'
        ]);
    $services->set(MailjetClientFactory::class)
        ->arg('$extConf', service('ExtConf.mailjet'));

    $services->set('MailjetClient', Client::class)
        ->factory([service(MailjetClientFactory::class), 'getMailjetClient']);

    $services->set(ApiService::class)
        ->arg('$client', service('MailjetClient'));

    $services->set(SecureCheckService::class);
};
