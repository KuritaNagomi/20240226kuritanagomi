<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'string', 'max:5'],
            'tel2' => ['required', 'string', 'max:5'],
            'tel3' => ['required', 'string', 'max:5'],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120']
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'tel1 .required' => '電話番号を入力してください',
            'tel2 .required' => '電話番号を入力してください',
            'tel3 .required' => '電話番号を入力してください',
            'tel1 .max' => '電話番号は５桁までの数字で入力してください',
            'tel2 .max' => '電話番号は５桁までの数字で入力してください',
            'tel3 .max' => '電話番号は５桁までの数字で入力してください',
            'tel1 .string' => '電話番号を半角数字で入力してください',
            'tel2 .string' => '電話番号を半角数字で入力してください',
            'tel3 .string' => '電話番号を半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力しください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください'
        ];
    }
}
