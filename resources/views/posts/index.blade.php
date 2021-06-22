@extends('layouts.app')

@section('content')



@section('content')
<div class="d-flex justify-content-end  mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">+Add Post</a>
</div>

<div class="card card-default">
    <div class="card-header"><h4>Posts</h4></div>

    <div class="card-body">
@if($posts->count() > 0 )

<table class="table">
    <thead>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Content</th>
        <th></th>
        <th></th>


    </thead>

    <tbody>

        @foreach($posts as $post)

        <tr>
            <td><img src="{{ url('storage/',$post->image) }}" height="px" width="100px" alt=""></td>

            <td>{{ $post->title }}</td>

             <td>

                {{-- <a href="{{ route('categories.edit', $post->category->id)  }}"> --}}

                 {{-- {{ $post->category->name  }} --}}

            </a>

            </td>
            <td>
                {!! $post->content !!}


            </td>

            @if($post->trashed())

            <td>
                <form action="{{ route('restore-post', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-info btn-sm">Restore</button>

                </form>
            </td>

            @else

            <td>
                <a href="{{ route('posts.edit',$post->id ) }}" class="btn btn-info btn-sm">Edit</a>
            </td>

            @endif

            <td>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm" type="submit">
                        {{ $post->trashed() ? 'Delete' : 'Trash' }}
                    </button>
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>

</table>

@else
<h5 class="text-center">No posts yet </h5>

@endif
    </div>
</div>


@endsection
