@php
    $title = 'Postni o`zgartirish' ;
@endphp
@extends('components.main')

@section('content')
    <x-page-header>
        Postni o`zgartirish {{ $post->id }}
    </x-page-header>

    <div class="container col-lg-7 mb-5 mb-lg-0">
        <div class="contact-form">
            <div id="success"></div>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="control-group mb-4">
                    <input type="text" class="form-control p-4" value="{{ $post->title }}" name="title"
                        placeholder="Sarlavha" />
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class=" mb-4 control-group">
                    <input name="photo" type="file" class="form-control p-4" id="subject" placeholder="Rasm" />
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="control-group mb-4">
                    <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{ $post->short_content }}</textarea>
                    @error('short_content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="control-group mb-4">
                    <textarea class="form-control p-4" rows="6" name="content" placeholder="Ma'qola">{{ $post->content }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-primary btn-block py-3 px-5" type="submit">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
@endsection
