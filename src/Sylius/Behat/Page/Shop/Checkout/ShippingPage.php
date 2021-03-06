<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Page\Shop\Checkout;

use Behat\Mink\Exception\ElementNotFoundException;
use Sylius\Behat\Page\SymfonyPage;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class ShippingPage extends SymfonyPage implements ShippingPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'sylius_shop_checkout_shipping';
    }

    /**
     * {@inheritdoc}
     */
    public function selectShippingMethod($shippingMethod)
    {
        $shippingMethodElement = $this->getElement('shipping_method');
        $shippingMethodValue = $this->getElement('shipping_method_option', ['%shipping_method%' => $shippingMethod])->getValue();

        $shippingMethodElement->selectOption($shippingMethodValue);
    }

    /**
     * {@inheritdoc}
     */
    public function hasShippingMethod($shippingMethod)
    {
        try {
            $this->getElement('shipping_method_option', ['%shipping_method%' => $shippingMethod]);
        } catch (ElementNotFoundException $exception) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function hasNoShippingMethodsMessage()
    {
        try {
            $this->getElement('order_cannot_be_shipped_message');
        } catch (ElementNotFoundException $exception) {
            return false;
        }

        return true;
    }

    public function nextStep()
    {
        $this->getDocument()->pressButton('Next');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'order_cannot_be_shipped_message' => '#sylius-order-cannot-be-shipped',
            'shipping_method' => '[name="sylius_shop_checkout_shipping[shipments][0][method]"]',
            'shipping_method_option' => '.item:contains("%shipping_method%") input',
        ]);
    }
}
