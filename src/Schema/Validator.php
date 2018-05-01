<?php

namespace Realfa\Common\Schema;

use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator as JsonSchema;

/**
 * Class Validator
 *
 * @package LazyFramework\Schema
 */
class Validator
{

    /**
     * @param array $schema
     * @param array $request
     *
     * @return bool
     * @throws \Exception
     */
    public static function validate(array $schema, array $request)
    {
        $validator = new JsonSchema();

        $dados = json_decode(json_encode($request));

        $validator->validate($dados, $schema, Constraint::CHECK_MODE_COERCE_TYPES);

        if (!$validator->isValid()) {
            throw new Exception($validator);
        }

        return true;
    }
}
