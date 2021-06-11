<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('post.store') }}" method="post">

                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp"
                                   value="{{ old('title', !empty($attribute->title) ? $attribute->title :'')}}"
                                   required
                                   name="title">

                            @error('title')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="body" class="form-label">body</label>
                            <input type="text" class="form-control" id="body" aria-describedby="bodyHelp"
                                   value="{{ old('body', !empty($attribute->body) ? $attribute->body :'')}}"
                                   required
                                   name="body">
                            @error('body')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
