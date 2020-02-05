@extends('layouts.boot')

@section('page-title', "Контакты - ")

@section('header-title', "Контакты")

@section('content')
    @if (count($contacts) == 1)
        @includeIf("contact-page::site.includes.single")
    @elseif (count($contacts) <= 4)
        @includeIf("contact-page::site.includes.middle")
    @elseif (count($contacts) > 4)
        @includeIf("contact-page::site.includes.many")
    @else
        Нет адресов
    @endif
@endsection
