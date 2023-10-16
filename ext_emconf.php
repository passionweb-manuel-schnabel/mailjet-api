<?php

$EM_CONF[$_EXTKEY] = [
  'title' => 'Mailjet API',
  'description' => "Mailjet API integration so users can subscribe to your newsletter(s) and be added to your Mailjet mailing list(s)",
  'category' => 'plugin',
  'author' => 'Manuel Schnabel',
  'author_email' => 'service@passionweb.de',
  'state' => 'stable',
  'version' => '1.0.0',
  'constraints' => [
    'depends' => [
      'typo3' => '11.5.0-12.4.99',
    ],
    'conflicts' => [],
    'suggests' => [],
  ],
];
