@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        <h4>{{ isset($post) ? 'Edit Post' : 'Create Post' }}</h4>
    </div>

    <div class="card-body">

        @include('partials.errors')

    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

@if(isset($post))

@method('PUT')

@endif

    <div class="form-group">
        <label for="title">Title</label>
        <input name="title" type="text"  id="title" class="form-control" value=" {{old('title')}} {{ isset($post) ? $post->title : '' }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>

        <textarea name="description" id="description" cols="5" rows="5" class="form-control"> {{old('description')}} {{ isset($post) ? $post->description : '' }}</textarea>

    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <input id="content"  type="hidden" name="content" value=" {{old('content')}} {{ isset($post) ? $post->content : '' }}">
        <trix-editor input="content"></trix-editor>
    </div>


    <div class="form-group">
        <label for="published_at">published at</label>
        <input name="published_at" type="text"  id="published_at" class="form-control" value="{{old('published_at')}} {{ isset($post) ? $post->published_at : '' }}">
    </div>

@if(isset($post))

<div class="form-group">
    <img src="{{url('storage/',$post->image)}}" alt="" style="width:100%">
</div>

@endif

    <div class="form-group">
        <label for="image">Image</label>
        <input name="image" type="file"  id="image" class="form-control">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control" >
            <option value="" selected disabled>Select</option>
            @foreach ($categories as $category)

                <option value="  {{$category->id}}"

                   @if (isset($post))
                   @if ($category->id == $post->category->id)
                   selected
               @endif
                   @endif
                    >
                    {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>

 @if($tags->count() > 0)
 <div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>

        {{-- <option value="" selected disabled> Select</option> --}}
        @foreach ($tags as $tag)

        <option value="  {{$tag->id}}"
            @if(isset($post))
            @if($post->hasTag($tag->id))
            selected

            @endif
            @endif
            >
             {{ $tag->name }}

            </option>
        @endforeach

    </select>
</div>

 @endif

    <div class="form-group">
        <button type="submit" class="btn btn-success">{{isset($post) ? 'Update Post' : 'Create Post'}}
        </button>
    </div>

    </form>
    </div>
</div>

@endsection


@section('scripts')

{{-- script trix editor --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
{{-- script date picker --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- tag selector --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    flatpickr('#published_at', {

        enableTime: true
    })

    $(document).ready(function() {
    $('.tags-selector').select2();
})
</script>

@endsection

@section('css')
{{-- link tag selector --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- trix editor --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
{{-- date picker --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
