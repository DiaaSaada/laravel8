<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>

        <a class="btn btn-info" href="{{route('category.create')}}">Create category</a>

    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="container overflow-hidden">
                        <div class="row">
                            @foreach( $categories as $category )
                                <div class="col-4 mb-3  ">
                                    <div class="card" style="width: 100%;">
                                        <img
                                            src="{{ $category->image ?? 'https://useinsider.com/assets/img/logo-old.png' }}"
                                            class="card-img-top p-md-5" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $category->title }}</h5>
                                            <p class="card-text">{{ \Illuminate\Support\Str::words( $category->body ,  9 , '...' )}}</p>
                                            <a href="{{ route('category.show' , [ 'slug' => $category->slug ]) }}"
                                               class="btn btn-primary">read
                                                more..</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
