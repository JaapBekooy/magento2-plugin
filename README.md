# Webshoplocatie Extended Integration for Magento 2
Magento 2 Extensions (based in the Picqer Magento 2 extension)

## Installation:
This project can easily be installed through Composer.

```
composer require webshoplocatie/magento2-plugin
bin/magento module:enable Webshoplocatie_Integration
bin/magento setup:upgrade
```

## Remove:
This project can easily be removed.

```
bin/magento module:disable Webshoplocatie_Integration
bin/magento setup:upgrade
composer remove webshoplocatie/magento2-plugin
```

## Activate module
1. Log onto your Magento 2 admin account and navigate to Stores > Configuration > Webshoplocatie > Webhooks
2. Fill out the general configuration information:
    + Active: Yes
    + Webhook URL: Url for the webshoplocatie webhook
    + Consumer Key: Enter a key
    + Consumer Secret: Enter a secret value

Orders will now be pushed to Webshoplocatie immediately.

## Uninstall:

```
composer remove webshoplocatie/magento2-plugin
```
