<?php
namespace Petstore\tests\Core;

use PHPUnit\Framework\TestCase;
use Petstore\Core\Payment;
use Petstore\Core\Pet;

class PaymentTest extends TestCase
{
    public function test_getOptionalDeposite() {
        $this->assertSame(600, Payment::getOptionalDeposite(3000));
    }

    public function test_getOptionalPayout() {
        $this->assertSame(2400, Payment::getOptionalPayout(3000));
    }

    public function test_getReturnAmount() {
        $this->assertSame(2400, Payment::getReturnAmount(3000));
    }

}
