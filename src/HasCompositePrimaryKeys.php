<?php

namespace lyragosa\Laravel\Eloquent\HasCompositePrimaryKeys;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait HasCompositePrimaryKeys {
    /**
     * Get the primary key for the model.
     *
     * @return array
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        foreach ($keys as $key) {
            if ($this->$key)
                $query->where($key, '=', $this->$key);
            else
                throw new Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
        }

        return $query;
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts()
    {
        if ($this->getIncrementing()) {
            return array_merge([$this->getKeyName() => $this->getKeyType()], $this->casts);
        }
        return $this->casts;
    }

    /**
     * Get the value of the model's primary key.
     *
     * @return mixed
     */
    public function getKey()
    {
        $fields = $this->getKeyName();
        $keys = [];
        array_map(function($key) use(&$keys) {
            $keys[] = $this->getAttribute($key);
        }, $fields);
        return $keys;
    }

    /**
     * Finds model by primary keys
     *
     * @param array $ids
     * @return mixed
     */
    public static function find(array $ids)
    {
        $modelClass = self::class;
        $model = new $modelClass();
        $keys = $model->primaryKey;
        return $model->where(function($query) use($ids, $keys) {
            foreach ($keys as $idx => $key) {
                if (isset($ids[$key])) {
                    $query->where($key, $ids[$key]);
                } else {
                    $query->whereNull($key);
                }
            }
        })->first();
    }

    /**
     * Find model by primary key or throws ModelNotFoundException
     *
     * @param array $ids
     * @return mixed
     */
    public function findOrFail(array $ids)
    {
        if (!isset($this)) {
            $modelClass = self::class;
            $model = new $modelClass();
        } else {
            $model = $this;
        }
        $record = $model->find($ids);
        if (!$record) {
            throw new ModelNotFoundException;
        }
        return $record;
    }

}
