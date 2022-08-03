<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'settings' => ['required', 'array'],
            'settings.type' => ['required', 'string'],
            'settings.tags' => ['required', 'array'],
            'settings.tags.*' => ['required', 'string'],
            'settings.priority' => ['required'],
            'settings.category' => ['required', 'string'],
            'settings.status' => ['required', 'string'],
            'settings.note' => ['required'],
            'subject' => ['required'],
            'users' => ['required', 'array'],
            'users.*' => ['required', 'integer', 'exists:users,id']
        ];
    }
}
