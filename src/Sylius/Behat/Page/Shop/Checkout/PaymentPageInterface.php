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

/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
interface PaymentPageInterface
{
    /**
     * @param string $paymentMethod
     */
    public function selectPaymentMethod($paymentMethod);
    
    /**
     * @param string $paymentMethodName
     * 
     * @return bool
     */
    public function hasPaymentMethod($paymentMethodName);

    public function nextStep();
}
