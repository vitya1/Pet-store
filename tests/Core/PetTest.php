<?php
namespace Petstore\tests\Core;

use PHPUnit\Framework\TestCase;
use Petstore\Core\Pet;

class PetTest extends TestCase
{
    /**
     * @dataProvider provider_isChipRequiredPet
     */
    public function test_isChipRequiredPet($expected, $type) {
        $pet = new Pet();
        $pet->type = $type;
        $this->assertSame($expected, $pet->isChipRequiredPet());
    }

    public function provider_isChipRequiredPet()
    {
        return [
            'dog'     => [true, Pet::TYPE_DOG],
            'cat'     => [true, Pet::TYPE_CAT],
            'bird'    => [false, Pet::TYPE_BIRD],
            'unknown' => [false, 9999999999],
        ];
    }

    /**
     * @dataProvider provider_isSellable
     */
    public function test_isSellable($expected, $type, $location, $chip_id) {
        $pet = new Pet(['type' => $type, 'location' => $location, 'chip_id' => $chip_id]);
        $this->assertSame($expected, $pet->isSellable());
    }

    public function provider_isSellable()
    {
        return [
            'dog without chip' => [false, Pet::TYPE_DOG, Pet::LOCATION_SHOWROOM, null],
            'cat without chip' => [false, Pet::TYPE_CAT, Pet::LOCATION_SHOWROOM, null],
            'bird without chip' => [true, Pet::TYPE_BIRD, Pet::LOCATION_SHOWROOM, null],
            'sold bird' => [false, Pet::TYPE_BIRD, Pet::LOCATION_BUYER, null],
            'sold cat' => [false, Pet::TYPE_CAT, Pet::LOCATION_BUYER, null],
            'sold dog' => [false, Pet::TYPE_DOG, Pet::LOCATION_BUYER, null],
            'dog with chip' => [true, Pet::TYPE_DOG, Pet::LOCATION_SHOWROOM, 123],
            'cat with chip' => [true, Pet::TYPE_CAT, Pet::LOCATION_BACKYARD, 456],
        ];
    }

    /**
     * @dataProvider provider_canBeReturned
     */
    public function test_canBeReturned($expected, $is_insured, $sale_time, $sold) {
        $pet = $this->getMockBuilder(Pet::class)
            ->setMethods(['time', 'isSold'])->getMock();
        $pet->method('time')->willReturn(30 * Pet::INSURANCE_LIFETIME);
        $pet->method('isSold')->willReturn($sold);

        $pet->is_insured = $is_insured;
        $pet->sale_time = $sale_time;

        $this->assertSame($expected, $pet->canBeReturned());
    }

    public function provider_canBeReturned()
    {
        return [
            'pet in the shop' => [false, false, 30 * Pet::INSURANCE_LIFETIME, false],
            'pet without insurance' => [false, false, 30 * Pet::INSURANCE_LIFETIME, true],
            'pet with expired insurance' => [false, false, 25 * Pet::INSURANCE_LIFETIME, true],
            'pet with insurance' => [true, true, 29 * Pet::INSURANCE_LIFETIME, true],
        ];
    }

}
