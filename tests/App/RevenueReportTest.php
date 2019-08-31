<?php
namespace Petstore\tests\App;

use PHPUnit\Framework\TestCase;
use Petstore\App\RevenueReport;
use Petstore\Core\Payment;
use Petstore\Core\Store;
use Petstore\Core\Pet;

class RevenueReportTest extends TestCase {

    public function test_handle() {
        $store = $this->getStoreMock();
        $showroom = $this->getShowroomMock($store);

        $result = $showroom->calculateData();
        $expected = [
            'buy' => 3700,
            'return' => 3000,
            'insurance' => 1000,
            'veterinar' => 400,
            'deposite' => 0,
            'payout' => 0,
            'imonilazed_sum' => 800,
            'total_sum' => 1300,
        ];

        $this->assertSame($expected, $result);    
    }

    /**
     * @return RevenueReport
     */
    private function getShowroomMock($store) {

        $showroom = $this->getMockBuilder(RevenueReport::class)
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
            new Payment([
                'time'=> 10, 'type'=> 'insurance', 'sum'=> 1000
            ]),
            new Payment([
                'time'=> 10, 'type'=> 'buy', 'sum'=> 3700
            ]),
            new Payment([
                'time'=> 10, 'type'=> 'return', 'sum'=> 3000
            ]),
            new Payment([
                'time'=> 10, 'type'=> 'veterinar', 'sum'=> 200
            ]),
            new Payment([
                'time'=> 10, 'type'=> 'veterinar', 'sum'=> 200
            ]),
        ];

        $mock = $this->createMock(Store::class);
        $mock->method('getAllPayments')->willReturn($items);

        return $mock;
    }

}