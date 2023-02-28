<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniquePhoneNumber implements Rule
{
    public $modelName;
    public $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($modelName, $id = null)
    {
        $this->modelName = $modelName;
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $model = app('\\App\\' . $this->modelName);
        $phoneNumber = '966' . intval($value);

        if(isset($this->id)){
            return $model::withTrashed()->where([['id', '!=', $this->id],[$attribute, $phoneNumber]])->doesntExist();
        }

        return $model::withTrashed()->where('phone', $phoneNumber)->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique');
    }
}
