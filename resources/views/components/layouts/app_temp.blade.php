@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

@extends('components.layouts.base_layout')

@section('base_layout_content')
    <div class="map-container"></div>
    
    @include('components.layouts.inc.navbar')

    <livewire:login />

    <main>
        {{ $slot }}
    </main>
        
    
    @include('components.layouts.inc.footer')


@endsection
