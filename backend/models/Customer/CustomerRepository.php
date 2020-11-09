<?php

namespace backend\models\Customer;

use backend\models\Customer\Dto\CustomerDto;

/**
 * Class CustomerRepository
 */
class CustomerRepository
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * CustomerRepository constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param CustomerDto $dto
     */
    public function add(CustomerDto $dto)
    {
        $attributes = [
            'age' => $dto->getAge(),
            'first_name' => $dto->getFirstName(),
            'last_name' => $dto->getLastName(),
            'email' => $dto->getEmail(),
            'phone' => $dto->getPhone(),
        ];

        $this->customer->attributes = $attributes;
        $this->customer->save();

        return $this->customer;
    }
}
