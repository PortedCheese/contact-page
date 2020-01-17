@can("viewAny", \App\Contact::class)
    <li class="nav-item">
        <a href="{{ route('admin.contact.index') }}"
           class="nav-link{{ strstr($currentRoute, 'admin.contact.') !== FALSE ? ' active' : '' }}">
            @isset($ico)
                <i class="{{ $ico }}"></i>
            @endisset
            Контакты
        </a>
    </li>
@endcan