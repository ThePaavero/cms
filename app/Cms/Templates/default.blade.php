@extends('cms::layouts.main')

@section('content')
    {{--{{ dump($data) }}--}}
    <h1>{!! $cms->render('Heading') !!}</h1>


    <div class='text-block-wrapper'>
        {!! $cms->render('Text Block') !!}
    </div>
    <!-- text-block-wrapper -->

@endsection
