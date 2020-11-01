@extends('layouts.app')

@section('content')
<div id="poll-app">
	<poll-list :polls="{{ json_encode($poll_datas) }}"/>
</div>
@endsection
