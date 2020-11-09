<?php

namespace backend\models\Customer\Service;

use backend\models\Customer\Customer;
use backend\models\Customer\CustomerRepository;
use backend\models\Customer\Dto\CustomerDto;

/**
 * Class CustomerService
 */
class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $repository;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $repository
     */
    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CustomerDto $dto
     *
     * @return Customer
     */
    public function createCustomer(CustomerDto $dto): Customer
    {
        return $this->repository->add($dto);
    }

    /**
     * @param CustomerDto $customer
     *
     * @return string
     */
    public function showCustomerName(CustomerDto $customer): string
    {
        return sprintf('%s %s', $customer->getFirstName(), $customer->getLastName());
    }
}
