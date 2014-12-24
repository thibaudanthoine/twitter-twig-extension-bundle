Twitter-twig-extension-bundle
=============================

.. image:

.. image:: https://travis-ci.org/thibaudanthoine/twitter-twig-extension-bundle.svg?branch=master
   :alt: Build status
   :target: https://travis-ci.org/thibaudanthoine/twitter-twig-extension-bundle

Provides Twig extension for facilitating Twitter buttons integration.

Installation
------------

1 - Add package to your ``composer.json``:

.. code-block:: json

    {
        "require": {
            "thibaudanthoine/twitter-twig-extension-bundle": "dev-master"
        }
    }

2 - Edit your ``app/AppKernel.php`` and register bundle:

.. code-block:: php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Thibaud\TwitterTwigExtensionBundle\ThibaudTwitterTwigExtensionBundle(),
        );

        // ...

3 - Finally configure the service in ``app/config/config.yml``:

.. code-block:: yaml

    thibaud_twitter_twig_extension:
        enabled: true
        lang: "%locale%"
        large: true
        buttons:
            share:
                show_count: true
            follow:
                username: "thibaudanthoine"
                show_username: true

Using Twitter twig extension bundle
-----------------------------------

To include Twitter button (share or follow) in your application, simply use twig functions below:

.. code-block:: html+jinja

    {{ twitter_button_share() }}

    <!-- OR -->

    {{ twitter_button_follow() }}
