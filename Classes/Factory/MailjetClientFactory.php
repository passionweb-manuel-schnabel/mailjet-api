<?php

namespace Passionweb\MailjetApi\Factory;


use Mailjet\Client;

class MailjetClientFactory
{
    protected array $extConf;
    public function __construct(array $extConf) {
        $this->extConf = $extConf;
    }
    public function getMailjetClient(): Client
    {
        return new Client(
            $this->extConf['mailjetApiKey'],
            $this->extConf['mailjetSecretKey'],
            true,
            [
                'version' => $this->extConf['mailjetApiVersion']
            ]
        );
    }
}
