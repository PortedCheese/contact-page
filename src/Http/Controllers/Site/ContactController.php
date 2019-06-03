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
        foreach (Contact::all() as $item) {
            $links = [];
            foreach ($item->links_data as $linkName => $linkData) {
                if (empty($linkData)) {
                    continue;
                }
                if ($linkName == 'webs') {
                    foreach ($linkData as &$web) {
                        $exploded = explode("//", $web['value']);
                        if (count($exploded) == 2) {
                            $web['humanValue'] = $exploded[1];
                        }
                    }
                }
                $links[$linkName] = $linkData;
            }
            $contacts[] = (object) [
                'model' => $item,
                'days' => $item->work_times,
                'socials' => !empty($links['socials']) ? $links['socials'] : false,
                'webs' => !empty($links['webs']) ? $links['webs'] : false,
                'emails' => !empty($links['emails']) ? $links['emails'] : false,
                'phones' => !empty($links['phones']) ? $links['phones'] : false,
            ];
        }
        return view('contact-page::site.page', [
            'contacts' => $contacts,
            'currentDay' => date('w', time()),
            'customTheme' => siteconf()->get('contact-page.customTheme'),
            'pageMetas' => Meta::getByPageKey('contacts'),
        ]);
    }
}
