<?php

namespace Realfa\Common\Pipeline;

class TerminateException extends \Exception {

    /**
     *
     * @var array 
     */
    private $payload;

    /**
     * 
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        parent::__construct('Pipeline - parada de emergência!', 9999);
        
        $this->payload = $payload;
    }

    /**
     * 
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
