# Picqer Extended Integration for Magento 2
Magento 2 Extensions for Picqer.

## Installation:
This project can easily be installed through Composer.

```
composer require jaapbekooy/magento2-plugin
bin/magento module:enable Picqer_Integration
bin/magento setup:upgrade
```

## Activate module
1. Log onto your Magento 2 admin account and navigate to Stores > Configuration > Picqer > Webhooks
2. Fill out the general configuration information:
    + Active: Yes
    + Order webhook url: is the url to call to push a new order.
    + Connection Key: can be found in Picqer > Settings > Webshops > Magento shop. Copy and paste in this field.

Orders will now be pushed to Picqer immediately.

## Uninstall:

```
composer remove picqer/magento2-plugin
```
