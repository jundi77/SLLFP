@extends('layouts.app')

@section('content')
<script 
      type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-VilpzLr9ufCPFYZN"
></script>
<div class="content">
	<div class="jumbotron text-center">
	    <button class="btn btn-dark" style="font-size: 10rem" onclick="snap.pay('{{ $snapToken }}')">BOOST NOW!</button>
	</div>
    </div>
@endsection
