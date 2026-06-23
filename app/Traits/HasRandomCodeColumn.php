<?php

namespace App\Traits;

trait HasRandomCodeColumn
{
    protected static function bootHasRandomCodeColumn()
    {
        static::creating(function ($model) {
            if ($model->generateRandomCodeOnCreate()) {
                $model = $model->generateRandomCode($model);
            }
        });

        static::saving(function ($model) {
            if ($model->generateRandomCodeOnCreate()) {
                $model = $model->generateRandomCode($model);
            }
        });

        static::updating(function ($model) {
            if ($model->generateRandomCodeOnUpdate()) {
                $model = $model->generateRandomCode($model);
            }
        });
    }

    public function generateRandomCode($model)
    {
        if (! $model->{$this->getRandomColumnName()}) {
            do {
                $model->{$this->getRandomColumnName()} = fake()->bothify('?????-#####');
            } while (static::where($this->getRandomColumnName(), $model->{$this->getRandomColumnName()})->exists());
        }

        return $model;
    }

    protected function getRandomColumnName(): string
    {
        return 'code';
    }

    protected function generateRandomCodeOnCreate(): int
    {
        return true;
    }

    protected function generateRandomCodeOnUpdate(): int
    {
        return true;
    }
}
