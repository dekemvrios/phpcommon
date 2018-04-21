<?php

namespace Realfa\Common\Pipeline;

use League\Pipeline\StageInterface;

/**
 * Class AbstractStep
 *
 * @package Realfa\Common\Pipeline
 */
abstract class AbstractStep implements StageInterface
{

    use HasPayloadTrait;

    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload)
    {
        $this->payload = $payload;

        $this->process();

        return $this->payload;
    }

    /**
     * @return mixed
     */
    abstract public function process();
}
