<?php

namespace PortedCheese\ContactPage\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Meta;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function page(Request $request)
    {
        $contacts = [];
        foreach (Contact::getForPage() as $item) {
            $contacts[] = $item->toRender();
        }
        return view('contact-page::site.page', [
            'contacts' => $contacts,
            'currentDay' => date('w', time()),
            'pageMetas' => Meta::getByPageKey('contacts'),
        ]);
    }
}
