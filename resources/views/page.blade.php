@extends('layouts.master')

@section('title', 'this is page title')

@section('sidebar')
    @parent
    
    <p>This is appended to master sidebar.</p>
@endsection

@section('content')
    <h2>{{$name}}</h2>
    <p>This is my body content</p>
    
    
    <h2>If Statement</h2>
    @if($day == 'Friday')
        <p>Time to partayy</p>
    @else
    <p>Time to make money</p>
    @endif
    
    <h2>Foreach loop</h2>
    <h3>Drinks</h3>
    <ul>
    @foreach ($drinks as $drink)
    <li>{{$drink}}</li>
    @endforeach
    </ul>
    
    <h2>Execute PHP Function</h2>
<p>The date is {{date(' D M, Y')}}</p>
    
@endsection
