<?php

namespace spec\Sylius\Bundle\CartBundle\Model;

use PHPSpec2\ObjectBehavior;

/**
 * Cart item spec.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CartItem extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\CartBundle\Model\CartItem');
    }

    function it_should_be_Sylius_cart_item()
    {
        $this->shouldImplement('Sylius\Bundle\CartBundle\Model\CartItemInterface');
    }

    function it_should_have_quantity_equal_to_1_by_default()
    {
        $this->getQuantity()->shouldReturn(1);
    }

    function it_should_have_unit_price_equal_to_0_by_default()
    {
        $this->getUnitPrice()->shouldReturn(0);
    }

    function it_should_have_total_equal_to_0_by_default()
    {
        $this->getTotal()->shouldReturn(0);
    }

    function it_should_calculate_correct_total()
    {
        $this->setQuantity(13);
        $this->setUnitPrice(14.99);

        $this->calculateTotal();

        $this->getTotal()->shouldReturn(194.87);
    }

    /**
     * @param Sylius\Bundle\CartBundle\Model\CartItemInterface $otherCartItem
     */
    function it_should_not_recognize_items_as_equal_if_they_do_not_have_the_same_id($otherCartItem)
    {
        $otherCartItem->getId()->willReturn(1);

        $this->equals($otherCartItem)->shouldReturn(false);
    }
}
