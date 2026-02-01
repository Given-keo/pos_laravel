@extends("layouts.app")
@section("content_title","dashboard")
@section("content")
<div class="card">
    <div class="card-body">
        Welcome to Pos Laravel Application <strong class="text-capitalize">{{ auth()->user()->name }}</strong>
    </div>
</div>

@endsection