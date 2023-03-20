@php
    $title = 'Post Yaratish';
@endphp
@extends('components.main')

@section('content')
    <x-page-header>
        Yangi Post Yaratish
    </x-page-header>


    <div class="row">
        <div class="container col-lg-7 mb-5 mb-lg-0">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="control-group mb-4">
                        <input type="text" class="form-control p-4" value="{{ old('title') }}" name="title"
                            placeholder="Sarlavha" />
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="control-group mb-4">
                        <label for="">Kategoriyasini tanlang</label>
                            <div class="col-sm-12 col-md-12">
                                <select class="form-control selectric" name="category_id">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="control-group mb-4">
                        <label for="">Taglarini belgilang</label>

                        <div class="col-sm-12 col-md-12">
                            <select class="form-control selectric" multiple name="tags[]">
                                @foreach ($tags as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                    <div class=" mb-4 control-group">
                        <input name="photo" type="file" class="form-control p-4" id="subject" placeholder="Rasm" />
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{ old('short_content') }}</textarea>
                        @error('short_content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="6" name="content" placeholder="Ma'qola">{{ old('content') }}</textarea>
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
    </div>
@endsection
