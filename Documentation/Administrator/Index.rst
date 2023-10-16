.. include:: ../Includes.txt


.. _administration_manual:

Administration Manual
=====================

Target group: **Administrators**

.. _installation:

Installation
^^^^^^^^^^^^

.. _add_via_composer:

Add via composer.json:
----------------------

.. code-block:: javascript

  composer require "passionweb/mailjet-api"

- Install the extension via composer
- Add the necessary RouteEnhancer (see :ref:`route_enhancer`)
- Add your Mailjet API key and secret key to the extension configuration before using the extension
- Flush TYPO3 and PHP Cache

.. _add_via_ter:

Add via TER:
------------

If you want to install the extension via TER you can find detailed instructions `here <https://docs.typo3.org/m/typo3/guide-installation/10.4/en-us/ExtensionInstallation/Index.html>`_.

- Install the extension via TER
- Add the necessary RouteEnhancer (see :ref:`necessary_route_enhancer`)
- Add your Mailjet API key and secret key to the extension configuration before using the extension
- Flush TYPO3 and PHP Cache


.. _configuration:

Configuration
^^^^^^^^^^^^^

.. _necessary_route_enhancer:

Necessary RouteEnhancer
-----------------------

- Add the following RouteEnhancer to the section `routeEnhancers` in your site configuration (`config.yaml`):

.. code-block:: none

    MailjetDoubleOptIn:
        type: Simple
        limitToPages: [ YOUR_PID ]
        routePath: '/{contact_id}'
        requirements:
            contact_id: '[0-9]{1,10}'
        _arguments: {}

Frontend configuration "enforceValidation" (TYPO3 v12)
------------------------------------------------------

If this setting is active you need to add the `contact_id` parameter to the `excludedParameters`.

.. code-block:: none

    'cacheHash' => [
        'enforceValidation' => true,
        'excludedParameters' => [
            'contact_id',
        ],
    ],

.. _extension_configuration:

Extension configuration
-----------------------

There are the following extension settings available.

Add your Mailjet API key and secret key to the extension configuration before using the extension. Furthermore you can add the current Version (only tested with v3).

.. code-block:: none

    # cat=Mailjet settings; type=string; label=Mailjet API key;
    mailjetApiKey= YOUR_MAILJET_API_KEY

Enter your Mailjet API key.

.. code-block:: none

    # cat=Mailjet settings; type=string; label=Mailjet secret key;
    mailjetSecretKey= YOUR_MAILJET_SECRET_KEY

Enter your Mailjet secret key.

.. code-block:: none

    # cat=Mailjet settings; type=string;  label=Mailjet API version
    mailjetApiVersion = v3

Enter the current Mailjet API version.

