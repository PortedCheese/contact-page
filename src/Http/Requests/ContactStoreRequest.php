<?php

namespace PortedCheese\ContactPage\Http\Requests;

use App\Contact;
use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
        return Contact::requestContactStore($this);
    }

    public function attributes()
    {
        return Contact::requestContactStore($this, true);
    }
}
