Getting started with VM6 API Bundle
===================================

This Symfony bundle allows you to seamlessly integrate the MovingIMAGE Video
Manager 6 into your PHP application built on top of the Symfony framework.

Prerequisites
-------------

This version requires version 2.7+ or 3.0+ of the Symfony framework, and supports
version 6.* of the Guzzle HTTP client.

Installation
------------

Installing this bundle is a quick and simple process that should only take a minute.

Install library with composer
_____________________________

First you have to install it using Composer:

.. code-block:: bash

    $ composer require movingimage/vm6-api-bundle

Enable bundle
_____________

Enable the bundle in your kernel:

.. code-block:: php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new MovingImage\Bundle\VM6ApiBundle\VM6ApiBundle(),
            );

            // ...
        }

        // ...
    }
    ```

Configuration
_____________

All you need is some basic configuration inside your ``app/config/config.yml``:

.. code-block:: yaml

    vm6_api:
        base_url:         %vm6_base_url%
        credentials:
            apiKey:       %apiKey%
            developerKey: %developerKey%
            clientKey:    %clientKey%

Please note that you will have to either define the parameters (between the '%%'
in the example) in your own ``parameters.yml``, or exchange them with your
pre-existing parameters.

You may omit the ``base_url`` parameter, in which case it will default to the **production**
API base URL for Video Manager 6.

Testing API connection
----------------------

After following the installation steps, you can test whether the bundle is able to successfully
interact with the MovingIMAGE Video Manager 6 API.

You can use the console command to test your connection:

.. code-block:: bash

    $ ./bin/console vm6-api:test-connection

If the connection was successful, you should see this:

.. code-block:: bash

    ✔ Connecting with the API succeeded.
