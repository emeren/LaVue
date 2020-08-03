@extends('backend.layouts.app')

@section('content')
<div id="app">

     <Dashboard :user='{{Auth::user()}}'></Dashboard>

</div>
@endsection