<?php

namespace backend\components\Booking;

use backend\components\util\Util;
use backend\models\Customer\dto\CustomerDto;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment as Twig;

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
     * @var Twig
     */
    private $twig;

    /**
     * BookingService constructor.
     * @param ClientInterface $client
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param Util $util
     * @param Twig $twig
     */
    public function __construct(
        ClientInterface $client,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        Util $util,
        Twig $twig
    )
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->logger = $logger;
        $this->twig = $twig;
    }

    /**
     * @param array
     *
     * @return CustomerDto
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function serialize(array $model): CustomerDto
    {
        $this->logger->info('serialize action');

        $customer = $this->serializer->fromArray($model, CustomerDto::class);

        $html = $this->twig->render('page.html', ['text' => 'Hello world', 'Customer' => $customer]);

        $errors = $this->validator->validate($customer);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
        }

        return $customer;
    }

    /**
     * @param string $raw
     *
     * @return CustomerDto
     */
    public function deserialize(string $raw): CustomerDto
    {
        $this->logger->info('deserialize action');

        $customer = $this->serializer->deserialize($raw, CustomerDto::class, 'json');

        $errors = $this->validator->validate($customer);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
        }

        return $customer;
    }
}
