<?php

namespace backend\utils\TransformData;

/**
 * Interface TransformDataInterface
 */
interface TransformDataInterface
{
    /**
     * @param mixed $data
     * @param string $dtoClass
     */
    public function transform($data, string $dtoClass);
}
