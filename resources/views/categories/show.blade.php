<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Blog') }}
        </h2>

        <a class="btn btn-info" href="{{route('post.create')}}">Create Post</a>

    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="container overflow-hidden">
                        <div class="row">


                            <div class="col-12 mb-3  ">
                                <div class="card" style="width: 100%;">
                                    <img
                                        src="{{ $post->image ?? 'https://useinsider.com/assets/img/logo-old.png' }}"
                                        class="card-img-top p-md-5" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{  $post->summary  }}</h6>

                                        <p class="card-text">{{ $post->body  }}</p>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
