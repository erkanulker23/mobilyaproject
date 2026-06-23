<?php

namespace Modules\Comment\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;

final class DeleteCommentValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        $rules = [
            'id' => [
                'required',
                'integer',
                'exists:comments,id',
            ],
        ];

        return $rules;
    }
}
