<?php

namespace Loka1\Admin\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Settings constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('admin.database.connection') ?: config('database.default'));

        $this->setTable(config('admin.extensions.config.table', 'admin_config'));
    }

    /**
     * Set the config's value.
     *
     * @param string|null $value
     */
    public function setValueAttribute($value = null)
    {
        if (config('admin.extensions.config.valueEmptyStringAllowed', false)) {
            $this->attributes['value'] = is_null($value) ? '' : $value;
        } else {
            $this->attributes['value'] = $value;
        }
    }
}
