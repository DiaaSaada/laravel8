<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('category.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp"
                                   value="{{ old('title', !empty($category->title) ? $category->title :'')}}"
                                   required
                                   name="title">

                            @error('title')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <input type="number" class="form-control" id="priority" aria-describedby="priorityHelp"
                                   value="{{ old('priority', !empty($category->priority) ? $category->priority :'')}}"
                                   required
                                   min="0"
                                   max="15"
                                   name="priority">
                            @error('priority')
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
