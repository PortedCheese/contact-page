<?php

namespace PortedCheese\ContactPage\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PortedCheese\ContactPage\Http\Requests\ContactStoreRequest;

class ContactController extends Controller
{
    /**
     * Список.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $config = siteconf()->get('contact-page');
        $themes = config('theme.themes');
        return view("contact-page::admin.index", [
            'config' => (object) $config,
            'themes' => $themes,
        ]);
    }

    public function saveSettings(Request $request)
    {
        $config = siteconf()->get('contact-page');
        foreach ($config as $key => $value) {
            if ($request->has($key)) {
                $config[$key] = $request->get($key);
            }
        }

        if ($request->has('theme')) {
            $config['customTheme'] = $request->get('theme');
        }
        else {
            $config['customTheme'] = null;
        }

        if ($request->has('own-admin')) {
            $config['useOwnAdminRoutes'] = true;
        }
        else {
            $config['useOwnAdminRoutes'] = false;
        }

        if ($request->has('own-site')) {
            $config['useOwnSiteRoutes'] = true;
        }
        else {
            $config['useOwnSiteRoutes'] = false;
        }

        siteconf()->save('contact-page', $config);
        return redirect()
            ->back()
            ->with('success', "Конфигурация обновлена");
    }

    /**
     * Сохранение контакта.
     *
     * @param ContactStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->all());
        return redirect()
            ->route('admin.contact.show', ['contact' => $contact])
            ->with('success', 'Контакт добавлен');
    }

    /**
     * Просмотр.
     *
     * @param Contact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Contact $contact)
    {
        return view("contact-page::admin.show", [
            'contact' => $contact,
        ]);
    }

    /**
     * Обновление заголовка.
     *
     * @param ContactStoreRequest $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactStoreRequest $request, Contact $contact)
    {
        $contact->update($request->all());
        return redirect()
            ->back()
            ->with('success', 'Успешно обновлено');
    }

    /**
     * Удаление.
     *
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Контакт удален');
    }

    /**
     * Обновить координаты метки.
     *
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function setCoord(Request $request, Contact $contact)
    {
        $data = $request->all();
        if (empty($data['coord']) || count($data['coord']) != 2) {
            return response()
                ->json([
                    'success' => false,
                ]);
        }
        $contact->longitude = $data['coord'][0];
        $contact->latitude = $data['coord'][1];
        $contact->save();
        return response()
            ->json([
                'success' => true,
            ]);
    }

    /**
     * Обновить рабочее время.
     *
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDays(Request $request, Contact $contact)
    {
        $data = $request->all();
        if (empty($data['days']) || count($data['days']) != 7) {
            return response()
                ->json([
                    'success' => false,
                ]);
        }
        $empty = true;
        foreach ($data['days'] as $day) {
            if (!empty($day['workTime']) || !empty($day['dinerTime'])) {
                $empty = false;
                break;
            }
        }
        if ($empty) {
            $contact->work_time = NULL;
        }
        else {
            $contact->work_time = $data['days'];
        }
        $contact->save();
        return response()
            ->json([
                'success' => true,
            ]);
    }

    /**
     * Обновить контакты.
     *
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function setLinks(Request $request, Contact $contact)
    {
        $data = $request->all();
        if (empty($data['info']) || count($data['info']) != 4) {
            return response()
                ->json([
                    'success' => false,
                ]);
        }
        $contact->links = $data['info'];
        $contact->save();
        return response()
            ->json([
                'success' => true,
            ]);
    }
}
