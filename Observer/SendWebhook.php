<?php

namespace Webshoplocatie\Integration\Observer;

use Magento\Framework\Event\ObserverInterface;

class SendWebhook implements ObserverInterface
{
    protected $_scopeConfig;
    protected $_curl;
    protected $_logger;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_curl = $curl;
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $active = $this->_scopeConfig->getValue('webshoplocatie_integration_options/webhook_settings/active');
        if ((int)$active !== 1) {
            return;
        }

        $webhookUrl = $this->_scopeConfig->getValue('webshoplocatie_integration_options/webhook_settings/webhook_url');
        $magentoKey = $this->_scopeConfig->getValue('webshoplocatie_integration_options/webhook_settings/consumer_key');
        $magentoSecret = $this->_scopeConfig->getValue('webshoplocatie_integration_options/webhook_settings/consumer_secret');

        if (empty($webhookUrl) || empty($magentoKey) || empty($magentoSecret)) {
            return; // Not fully configured
        }

        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getIncrementId();

        $signature = base64_encode(hash_hmac('sha256',$orderId, hash('md5', $magentoSecret), true));

        $orderData = [];
        $orderData['increment_id'] = $orderId;
        $orderData['signature'] = $signature;

        $this->_curl->setHeaders([
            'Content-Type' => 'application/json'
        ]);

        $this->_curl->setOptions([
            CURLOPT_TIMEOUT => 2 // in seconds
        ]);

        try {
            $this->_curl->post(sprintf('%s', trim($webhookUrl)), json_encode($orderData));
        } catch (\Exception $e) {
            $this->_logger->debug(sprintf('Exception occurred with Webshoplocatie: %s', $e->getMessage()));
        }
    }
}
