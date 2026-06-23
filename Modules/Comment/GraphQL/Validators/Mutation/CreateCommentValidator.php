<?php

namespace Modules\Comment\GraphQL\Validators\Mutation;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

final class CreateCommentValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        $rules = [
            'commentableId' => [
                'required',
                'integer',
            ],
            'commentableType' => [
                'required',
                'string',
                Rule::in(array_keys(config('comment.available_commentables'))),
            ],
            'comment' => [
                'required',
                'string',
            ],
            'parentId' => [
                'nullable',
                'integer',
            ],
        ];

        if (
            in_array($this->arg('commentableType'), array_keys(config('comment.available_commentables')))
        ) {
            $modelClass = new (config('comment.available_commentables.'.$this->arg('commentableType')));
            $modelTable = $modelClass->getTable();
            $rules['commentableId'][] = "exists:{$modelTable},id";
            // TODO: check if parent_id doesn't has parent
            // TODO: check if parent has same commentable id
        }

        return $rules;
    }
}
