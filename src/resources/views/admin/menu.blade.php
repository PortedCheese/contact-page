@can("viewAny", \App\Contact::class)
    <li class="nav-item{{ strstr($currentRoute, 'admin.contact.') !== FALSE ? ' active' : '' }}">
        <a href="{{ route('admin.contact.index') }}"
           class="nav-link{{ strstr($currentRoute, 'admin.contact.') !== FALSE ? ' active' : '' }}">
            @isset($ico)
                <i class="{{ $ico }}"></i>
            @endisset
            <span>Контакты</span>
        </a>
    </li>
@endcan