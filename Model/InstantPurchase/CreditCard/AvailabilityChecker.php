<?php
namespace Sapient\Worldpay\Model\InstantPurchase\CreditCard;

class AvailabilityChecker implements \Magento\InstantPurchase\PaymentMethodIntegration\AvailabilityCheckerInterface
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var wplogger
     */
    private $wplogger;

     /**
      * Constructor
      *
      * @param Sapient\Worldpay\Helper\Data $worldpayHelper
      * @param Sapient\Worldpay\Logger\WorldpayLogger $wplogger
      */
    public function __construct(
        \Sapient\Worldpay\Helper\Data $worldpayHelper,
        \Sapient\Worldpay\Logger\WorldpayLogger $wplogger
    ) {
        $this->config = $worldpayHelper;
        $this->wplogger = $wplogger;
    }

    /**
     * @inheritdoc
     */
    public function isAvailable(): bool
    {
        if ($this->config->isWorldPayEnable() &&
            $this->config->isCreditCardEnabled() &&
            $this->config->instantPurchaseEnabled()) {
            return true;
        }
         $this->wplogger->info("Instant Purchase is disabled:");
         return false;
    }
}
