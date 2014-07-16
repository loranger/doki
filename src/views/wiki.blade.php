@extends('doki::layout')

@section('title')
@parent
:: Wiki - {{ $page->title }}
@stop

@section('breadcrumbs')

<?php $i = 0; ?>
@foreach ($breadcrumbs as $name => $url)
    <?php $i++ ?>
    @if( $i >= count($breadcrumbs) )
        <li class="active">{{ $name }}</li>
    @else
        <li>{{ link_to($url, $name) }}</li>
    @endif
@endforeach

@stop

@section('content')
        {{ $page->content }}
@stop
