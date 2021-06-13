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
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp"
                                   value="{{ old('title', !empty($post->title) ? $post->title :'')}}"
                                   required
                                   name="title">

                            @error('title')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="summary" class="form-label">summary</label>
                            <input type="text" class="form-control" id="summary" aria-describedby="summaryHelp"
                                   value="{{ old('summary', !empty($post->summary) ? $post->summary :'')}}"
                                   required
                                   name="summary">
                            @error('summary')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image
                            </label>
                            <input type="file" ccept="image/*"  class="form-control" id="featured_image" aria-describedby="featured_imageHelp"

                                   required
                                   name="featured_image
">
                            @error('featured_image
')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label class="form-label">Featured Pos</label>
                            <input type="checkbox" class="form-check-input" id="is_featured"
                                   aria-describedby="is_featuredHelp"
                                   value="1"
                                   {{ empty( $post->is_featured) ? "" : "checked" }}
                                   required
                                   name="is_featured">
                            <label class="form-check-label" for="flexCheckDefault">
                                featured
                            </label>

                            @error('is_featured')
                            <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="body" class="form-label">body</label>
                            <textarea type="text" class="form-control" id="body" aria-describedby="bodyHelp"
                                      rows="12"
                                      required
                                      name="body">
                                {{ old('body', !empty($post->body) ? $post->body :'')}}
                            </textarea>
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
