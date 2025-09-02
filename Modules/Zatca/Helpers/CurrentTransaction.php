<?php

namespace Modules\Zatca\Helpers;

class CurrentTransaction
{
    protected static $transaction_id = null;

    /**
     * Set the current transaction ID.
     *
     * @param int $transaction_id
     * @return void
     */
    public static function setTransactionId(int $transaction_id): void
    {
        self::$transaction_id = $transaction_id;
    }

    /**
     * Get the current transaction ID.
     *
     * @return int|null
     */
    public static function getTransactionId(): ?int
    {
        return self::$transaction_id;
    }

    /**
     * Clear the current transaction ID.
     *
     * @return void
     */
    public static function clear(): void
    {
        self::$transaction_id = null;
    }
}
