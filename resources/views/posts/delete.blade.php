@extends('layouts.app')

@section('content')
    <h1>Delete Blog Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <ul>
        <li>ID: {{ $post->id }} </li>
        <li>Title: {{ $post->title }} </li>
        <li>Content: {{ $post->content }} </li>
    </ul>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
