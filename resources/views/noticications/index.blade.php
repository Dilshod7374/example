@php
    $title = 'Xabarnomalar';
@endphp
@extends('components.main')

@section('content')
    <x-page-header>
        Xabarnomalar
    </x-page-header>

    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h1 class="section-title mb-3">Xabarnomalar</h1>
                </div>
            </div>
            @foreach ($notifications as $notification)
                <div class="border mb-3 p-4 rounded">
                    <div class="position-relative mb-4">
                        <div class="blog-date">
                            <h4 class="font-weight-bold mb-n1">New</h4>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <a class="text-secondary text-uppercase font-weight-medium"
                            href="">{{ $notification->data['created_at'] }}</a>
                    </div>
                    <h5 class="font-weight-medium mb-2">{{ $notification->data['title'] }}</h5>
                    <p class="mb-4">{{ 'Yangi post yaratildi. id:' . $notification->data['post_id'] }}</p>
                    <a class="btn btn-sm btn-primary py-2"
                        href="{{ route('notifications.read', ['notifications' => $notification->id]) }}">O'qildi
                    </a>
                </div>
            @endforeach
            <div class="container">
                {{ $notifications->links() }}</div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
