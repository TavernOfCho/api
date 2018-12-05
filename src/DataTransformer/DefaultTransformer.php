<?php

namespace App\DataTransformer;


class DefaultTransformer extends AbstractTransformer
{
    /**
     * @var string $class
     */
    private $class;

    public function __construct(string $class)
    {
        parent::__construct();
        $this->class = $class;
    }

    /**
     * @param $data
     * @return object
     */
    public function transformItem($data)
    {
        return $this->fillProperties($data, $this->class);
    }

    public function transformCollection($data)
    {
        $data = array_map(function ($data) {
            return $this->transformItem($data);
        }, $data);

        return $data;
    }
}