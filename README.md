# Mailjet API extension for TYPO3

Mailjet API integration so users can subscribe to your newsletter(s) and be added to your Mailjet mailing list(s)

## Requirements

- TYPO3 >= 11.5.0
- PHP >= 7.4
- Mailjet API key and secret key

## Detailed documentation

Detailed documentation is available at the following link:

[https://docs.typo3.org/p/passionweb/mailjet-api/main/en-us/](https://docs.typo3.org/p/passionweb/mailjet-api/main/en-us/)

## Installation

    composer require "passionweb/mailjet-api"

- Install the extension via composer
- Add the necessary RouteEnhancer (see #necessary-routeenhancer)
- Add your Mailjet API key and secret key to the extension configuration before using the extension
- Flush TYPO3 and PHP Cache

## Configuration

### Necessary RouteEnhancer

- Add the following RouteEnhancer to the section `routeEnhancers` in your site configuration (`config.yaml`):


    MailjetDoubleOptIn:
        type: Simple
        limitToPages: [ YOUR_PID ]
        routePath: '/{contact_id}'
        requirements:
            contact_id: '[0-9]{1,10}'
        _arguments: {}


### Frontend configuration "enforceValidation" and "excludedParameters" (TYPO3 v12)

You need to add the `contact_id` parameter to the `excludedParameters` if you don't use the `limitToPages` option of the RouteEnhancer and if it should be possible to call the same page (where your mailjet verification plugin is included) with the contact_id as an argument an without the contact_id.


    $GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash'] = [
        'enforceValidation' => true,
        'excludedParameters' => [
            'contact_id',
        ],
    ];


### Extension configuration

There are the following extension settings available.

    # cat=Mailjet settings; type=string; label=Mailjet API key;
    mailjetApiKey= YOUR_MAILJET_API_KEY

Enter your Mailjet API key.

    # cat=Mailjet settings; type=string; label=Mailjet secret key;
    mailjetSecretKey= YOUR_MAILJET_SECRET_KEY

Enter your Mailjet secret key.

    # cat=Mailjet settings; type=string;  label=Mailjet API version
    mailjetApiVersion = v3

Enter the current Mailjet API version.

## Important notes

The extension uses the external service Mailjet. To use the extension, you need a Mailjet account and an API key For more information visit the `Mailjet website <https://www.mailjet.com/>`_.

## Troubleshooting and logging

If something does not work as expected take a look at the log file first.
Every problem is logged to the TYPO3 log (normally found in `var/log/typo3_*.log`)

## Achieving more together or Feedback, Feedback, Feedback

I'm grateful for any feedback! Be it suggestions for improvement, extension requests or just a (constructive) feedback on how good or crappy the extension is.

Feel free to send me your feedback to [service@passionweb.de](mailto:service@passionweb.de "Send Feedback") or [contact me on Slack](https://typo3.slack.com/team/U02FG49J4TG "Contact me on Slack")

