<?php

namespace Realfa\Common\Pipeline;

use Realfa\Common\Schema\Validator;

/**
 * Class ValidarPayload
 *
 * @package Realfa\Common\Pipeline
 */
class ValidarPayload extends AbstractStep
{
    const ERRO_ARGS = 'CONJUNTO DE ARGUMENTOS FORNECIDOS NÃO PODE SER VAZIO';

    /**
     * @throws \Exception
     */
    public function process()
    {
        if (!$dados = $this->optional('param')) {
            throw new \Exception(self::ERRO_ARGS, 400);
        }

        Validator::validate($this->required('rules'), $dados);
    }
}
