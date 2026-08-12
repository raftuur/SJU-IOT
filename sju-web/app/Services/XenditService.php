<?php

namespace App\Services;

use Exception;
use Xendit\Configuration;
use Xendit\Payout\PayoutApi;
use Xendit\Payout\CreatePayoutRequest;

class XenditService
{
    protected PayoutApi $payoutApi;

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        $this->payoutApi = new PayoutApi();
    }

    /**
     * Create Payout
     */
    public function createPayout(array $withdrawal)
    {
        try {

            $request = new CreatePayoutRequest([

                'reference_id' => $withdrawal['withdrawal_code'],

                'channel_code' => $withdrawal['bank_code'],

                'channel_properties' => [

                    'account_holder_name' => $withdrawal['account_name'],

                    'account_number' => $withdrawal['account_number'],

                ],

                'amount' => (float) $withdrawal['amount'],

                'currency' => 'IDR',

                'description' => 'Withdrawal SJU',

            ]);

            return $this->payoutApi->createPayout(

                uniqid('WD-'),

                null,

                $request

            );

        } catch (Exception $e) {

            throw $e;

        }
    }
}