<?php

namespace Realfa\Common\Schema;

use JsonSchema\Validator;

/**
 * Class Exception
 *
 * @package Realfa\Common\Schema
 */
class Exception extends \Exception
{

    /**
     * DataInvalidAgainstSchema constructor.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->message = $this->setMessage($validator);
    }

    /**
     * @param Validator $validator
     *
     * @return string
     */
    private function setMessage(Validator $validator): string
    {
        $messages = [];
        foreach ($validator->getErrors() as $error) {
            $error = $this->translate($error);

            $msg = sprintf("[%s] %s", $error['property'], $error['message']);

            $messages[] = $msg;
        }

        return implode(";", $messages);
    }

    /**
     * @param array $error
     *
     * @return array
     */
    public function translate(array $error): array
    {
        if ($message = $error['message'] ?? null) {
            $error['message'] = $this->message($message);
        }

        return $error;
    }

    /**
     * @param string $message
     *
     * @return string
     */
    private function message(string $message): string
    {
        $trEnPtBr = [
            "String value found, but a number is required" => "Espera-se valor numérico, porém fornecido texto.",
            "Does not have a value in the enumeration"     => "Valor fornecido inválido para o conjunto esperado",
            "Array value found, but an object is required" => "Formato de valor fornecido diferente do esperado.",

            "The property" => "A propriedade",
            "is required"  => "é obrigatória",
        ];

        return strtr($message, $trEnPtBr);
    }
}
