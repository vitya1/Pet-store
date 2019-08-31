<?php

namespace Petstore\App;

use Petstore\Core\Store;
use Petstore\Core\Pet;
use Petstore\Core\Payment;
use Petstore\App\Interfaces\UseCase as UseCaseInterface;

/**
 *  The pet shop owner would like to have a weekly revenue report. The report
 *  should also show the money immobilized (money the store owner might have to
 *  return to customers) because of the insurance policies .
 *
 * @see Petstore\tests\App\RevenueReportTest
 */
class RevenueReport implements UseCaseInterface {

    public function handle() {
        $data = $this->calculateData();
        return $this->getMessage($data);
    }

    /**
     * @return array
     */
    public function calculateData(): array {
        $three_months = 7 * 86400;
        $store = $this->createStoreInstance();
        $payments = $store->getAllPayments(['date_from' => $three_months]);
        $data = [
            Payment::TYPE_BUY_ITEM => 0,
            Payment::TYPE_RETURN => 0,
            Payment::TYPE_INSURANCE => 0,
            Payment::TYPE_VETERINAR => 0,
            Payment::TYPE_OPTIONAL_DEPOSITE => 0,
            Payment::TYPE_OPTIONAL_PAYOUT => 0,
        ];

        foreach($payments as $payment) {
            if(isset($data[$payment->type])) {
                $data[$payment->type] += $payment->sum;
            }
        }

        $data['imonilazed_sum'] = Payment::getReturnAmount($data[Payment::TYPE_INSURANCE]);
        $data['total_sum'] = $data[Payment::TYPE_BUY_ITEM]
         + $data[Payment::TYPE_OPTIONAL_DEPOSITE]
         + $data[Payment::TYPE_INSURANCE]
         + $data[Payment::TYPE_OPTIONAL_PAYOUT]
         - $data[Payment::TYPE_RETURN]
         - $data[Payment::TYPE_VETERINAR];

        return $data;
    }

    private function getMessage($data) {
         return 
        'Total revenue - '.$data['total_sum']."\n"
        .'Imobilazed sum - '.$data['imonilazed_sum']."\n"
        .'Veterinar Expenses - '.$data[Payment::TYPE_VETERINAR]."\n"
        .'Return sum - '.$data[Payment::TYPE_RETURN]."\n";
    }

    //@todo replace with DI
    public function createStoreInstance() {
        return new Store();
    }
}
