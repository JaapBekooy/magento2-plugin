# Webshoplocatie Extended Integration for Magento 2
Magento 2 Extensions for Webshoplocatie.

## Installation:
This project can easily be installed through Composer.

```
composer require jaapbekooy/magento2-plugin
bin/magento module:enable Webshoplocatie_Integration
bin/magento setup:upgrade
```

## Activate module
1. Log onto your Magento 2 admin account and navigate to Stores > Configuration > Webshoplocatie > Webhooks
2. Fill out the general configuration information:
    + Active: Yes
    + Order webhook url: The url to call to push a new order.
    + Connection Key: Unique Key (webshopid)

Orders will now be pushed to Webshoplocatie immediately.

## Uninstall:

```
composer remove jaapbekooy/magento2-plugin
```
