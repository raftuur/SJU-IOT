<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Sju extends BaseConfig
{
    /**
     * Nilai 1 point dalam rupiah.
     * Contoh:
     * 1 point = Rp1
     */
    public int $pointRate = 1;

    /**
     * Minimum point untuk withdrawal.
     */
    public int $minimumWithdrawalPoint = 100;

    /**
     * Minimum point untuk redeem voucher.
     */
    public int $minimumRedeemPoint = 100;
}