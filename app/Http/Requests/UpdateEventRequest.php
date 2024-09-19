<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'required|min:2|max:255',
            'slug' => 'unique:events,slug,' . $this->event->id,
            'description' => 'required|min:5|max:2000',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'image' => 'sometimes|image',
            'address' => 'required|max:250',
            'num_tickets' => 'required|integer|min:1',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'tags' => 'required|array',
            'tags.*' => 'required|exists:tags,id'
        ];
    }

    public function attributes()
    {
        return [
            'slug' => __('Title'),
            'title' => __('Title'),
            'city_id' => __('City'),
            'num_tickets' => __('N.º Tickets'),
            'country_id' => __('Country'),
            'tags.*' => __('Tags'),
            'address' => __('Address'),
            'start_date' => __('Start Date'),
            'end_date' => __('End Date'),
            'start_time' => __('Start Time'),
            'description' => __('Description'),
            'tags' => __('Tags')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->title)
        ]);
    }
}
