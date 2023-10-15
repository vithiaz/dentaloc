@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/admin_app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-add-clinic-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-clinic-list-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-add-doctor-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-doctor-list-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-add-news-page.css') }}">
@endpush

@extends('components.layouts.base_layout')

@section('base_layout_content')

    <main class="admin-layout">
        @include('components.admin.sidebar')

        <div class="layout-content">
            @include('components.admin.navbar')
            {{ $slot }}
        </div>
    </main>

@endsection
