<?php

namespace PortedCheese\ContactPage\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use PortedCheese\SeoIntegration\Models\Meta;

class ContactController extends Controller
{
    public function page()
    {
        $contacts = [];
        foreach (Contact::all()->sortBy("weight") as $item) {
            $contacts[] = $item->toRender();
        }
        return view('contact-page::site.page', [
            'contacts' => $contacts,
            'currentDay' => date('w', time()),
            'customTheme' => siteconf()->get('contact-page.customTheme'),
            'pageMetas' => Meta::getByPageKey('contacts'),
        ]);
    }
}
