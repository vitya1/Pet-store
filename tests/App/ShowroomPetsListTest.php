<?php
namespace Petstore\tests\App;

use PHPUnit\Framework\TestCase;
use Petstore\App\ShowroomPetsList;
use Petstore\Core\Store;
use Petstore\Core\Pet;

class ShowroomPetsListTest extends TestCase {

    public function test_getPetList() {
        $store = $this->getStoreMock();
        $showroom = $this->getShowroomMock($store);

        $this->assertValidPets($showroom->getPetList());
    }

    /**
     * @param Pet[] $pets
     */
    protected function assertValidPets($pets) {
        $this->assertCount(1, $pets);
        $item = array_pop($pets);
        $this->assertEquals('Trump', $item->name);
    }

    /**
     * @return ShowroomPetsList
     */
    private function getShowroomMock($store) {

        $showroom = $this->getMockBuilder(ShowroomPetsList::class)
            ->setMethods(['createStoreInstance'])
            ->getMock();

        $showroom->method('createStoreInstance')
            ->willReturn($store);

        return $showroom;
    }

    /**
     * @return Store
     */
    private function getStoreMock() {
        $items = [
            new Pet([
                'name' => 'Trump',
                'location' => null,
                'is_optional' => false,
            ]),
            new Pet([
                'name' => 'Ivanka',
                'location' => null,
                'is_optional' => true,
            ]),
            new Pet([
                'name' => 'Melania',
                'location' => Pet::LOCATION_BUYER,
                'is_optional' => false,
            ]),
        ];

        $mock = $this->createMock(Store::class);
        $mock->method('getAllItems')->willReturn($items);

        return $mock;
    }

}