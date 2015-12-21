@extends('cms::layouts.main')

@section('content')
    <h1>{{ $data['title'] }}</h1>

    {{ dump($data) }}
@endsection
