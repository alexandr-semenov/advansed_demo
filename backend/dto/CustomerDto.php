<?php
declare(strict_types = 1);

namespace backend\dto;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CustomerDto
 */
class CustomerDto
{
    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     *
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     *
     * @JMS\Type("integer")
     */
    private $age;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("first_name")
     */
    private $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("last_name")
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @JMS\Type("string")
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @JMS\Type("string")
     */
    private $phone;
}
