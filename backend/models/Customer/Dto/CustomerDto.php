<?php
declare(strict_types = 1);

namespace backend\models\Customer\Dto;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CustomerDto
 */
class CustomerDto implements DtoInterface
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
