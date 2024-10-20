<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => ['nullable', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'status' => ['nullable', 'array'],
            'status.*' => ['required', 'string', 'in:new,in_work,sent,delivered'],
            'sortBy' => ['nullable', 'array'],
            'sortBy.key' => ['nullable', 'string', 'in:id,product_name,amount,status,created_at'],
            'sortBy.by' => ['nullable', 'string', 'in:desc,asc'],
            'count_items' => ['nullable', 'integer']
        ];
    }
}
