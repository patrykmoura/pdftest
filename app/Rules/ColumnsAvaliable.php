<?php

namespace App\Rules;

use App\Models\Type;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ColumnsAvaliable implements ValidationRule
{
    public Type $type;

    public function __construct($id)
    {
        try {
            $this->type = Type::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json([
                'status' => 'erro',
                'message' => 'Erros de validação',
                'errors' => 'Type não encontrado',
            ], 422));
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'erro',
            'message' => 'Erros de validação',
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!in_array($value, $this->type->columns->pluck('id')->toArray())){
            $fail('The :attribute is invalid for the document type #'.$this->type->id.' - '.$this->type->name);
        }
    }
}
