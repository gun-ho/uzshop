<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if(session()->get('admin_login'))
            return true;
        else
            return false;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Не заполняли поля Названия',
            'slug.required'  => 'Не заполняли поля Таг',
            'image.required' => 'Рисунка не выбран',
            'image.max'      => 'Размер рисунка превышает 2 Мб',
            'image.image'    => 'Только рисунка',
            'image.mimes'    => 'Формат рисунка должен быть( jpeg, png, jpg, gif, svg )'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|max:200',
            'slug'  => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
