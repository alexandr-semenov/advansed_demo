<?php

namespace backend\components\Booking;

use backend\components\util\Util;
use backend\dto\CustomerDto;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BookingService
 */
class BookingService implements BookingInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface|ArrayTransformerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * BookingService constructor.
     * @param ClientInterface $client
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param Util $util
     */
    public function __construct(
        ClientInterface $client,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        Util $util
    )
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * @param array
     *
     * @return CustomerDto
     */
    public function serialize(array $model): CustomerDto
    {
        $this->logger->info('test log message');

        $customer = $this->serializer->fromArray($model, CustomerDto::class);

        $errors = $this->validator->validate($customer);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
        }

        return $customer;
    }
}
