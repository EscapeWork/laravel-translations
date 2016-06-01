<?php

namespace EscapeWork\Translations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Translation extends Model
{
    /**
     * Table.
     */
    protected $table = 'translations';

    /**
     * Fillable fields.
     */
    protected $fillable = [
        'model',
        'model_id',
        'locale',
        'slug',
        'data',
    ];

    public function translations()
    {
        return $this->morphTo();
    }

    public function newCollection(array $models = [])
    {
        return new TranslationCollection($models);
    }

    public function store($model, $locale, $fields, $options = [])
    {
        $this->model = get_class($model);
        $options = array_merge(['slug' => false, 'field' => 'title'], $options);
        $data = [
            'model'    => $this->model,
            'model_id' => $model->id,
            'locale'   => $locale,
            'data'     => serialize((array) $fields),
        ];

        if ($options['slug']) {
            $data['slug'] = $this->createSlug($fields[$options['field']]);
        }

        return static::create($data);
    }

    public function deleteFromModel($model)
    {
        $this->where('model', '=', get_class($model))
             ->where('model_id', '=', $model->id)
             ->delete();
    }

    protected function createSlug($title)
    {
        $this->slug = Str::slug($title);
        $count = 0;

        while ($this->slugExists()) {
            $count++;
            $this->slug = Str::slug($title).'-'.$count;
        }

        return $this->slug;
    }

    protected function slugExists()
    {
        return $this->where('model', '=', $this->model)
                    ->where('slug', '=', $this->slug)
                    ->first();
    }

    public function getField($field)
    {
        if ($this->{$field}) {
            return $this->{$field};
        }

        try {
            $data = unserialize($this->data);

            return isset($data[$field]) ? $data[$field] : null;
        }
        catch (\Exception $e) {
            \Log::error('Erro ao deserializar os dados do model ' . $this->model . ' #' .$this->model_id);
            return null;
        }
    }
}
