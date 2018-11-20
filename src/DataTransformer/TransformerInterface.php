<?php

namespace App\DataTransformer;

interface TransformerInterface
{
    public function transformItem($data);

    public function transformCollection($data);
}
