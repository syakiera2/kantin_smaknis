@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-3xl">
    <h1 class="mb-4 text-2xl font-bold text-[#7F5539]">Edit Menu</h1>

    <form method="POST" action="{{ route('admin.menus.update', $menu) }}" enctype="multipart/form-data"
          class="rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('pages.admin.menus._form')
    </form>
</div>
@endsection