<?php

namespace backend\components\Booking;

/**
 * Interface BookingInterface
 */
interface BookingInterface
{
    /**
     * @param array $model
     *
     * @return mixed
     */
    public function serialize(array $model);

    /**
     * @param string $model
     *
     * @return mixed
     */
    public function deserialize(string $model);
}
