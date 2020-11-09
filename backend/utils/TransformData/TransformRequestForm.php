<?php

namespace backend\utils\TransformData;

use JMS\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use yii\web\Request;

/**
 * Class TransformDataFromRequest
 */
class TransformRequestForm implements TransformDataInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * TransformDataFromRequest constructor.
     * @param Serializer $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(Serializer $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param Request $data
     * @param string $dtoClass
     *
     * @throws \Exception
     */
    public function transform($data, string $dtoClass)
    {
        if (!($data instanceof Request)) {
            throw new \Exception('data should be type of ' . Request::class);
        }

        if (!class_exists($dtoClass)) {
            throw new \Exception('Dto class not exist ');
        }

        $body = $data->getBodyParams();

        $dto = $this->serializer->fromArray($body, $dtoClass);

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new \Exception('Validation errors: ' . (string)$errors);
        }

        return $dto;
    }
}
