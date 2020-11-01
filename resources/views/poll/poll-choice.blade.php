@extends('layouts.app')

@section('content')
<div class="container" id="poll-app">
	<div class="text-center">
		<form action="#" method="post">
			@csrf
			@method('put')
			@if(($current_poll['poll']->author_id == auth()->user()->id) || $isAdmin)
			@if(!$current_poll['poll']->closed)
			<button type="submit" value="1" name="close" class="btn btn-danger">Tutup poll</button>
			@else
			<button type="submit" value="0" name="close" class="btn btn-success">Buka</button>
			@endif
			@endif
		</form>
		@if(($current_poll['poll']->author_id == auth()->user()->id) || $isAdmin)
		<a href="/buy/{{$current_poll['poll']->id}}" class="btn btn-primary" id="pay-button" onclick="pay()">BOOST VOTE</a>
		@endif
	</div>
	<poll-choice :about-poll="{{ json_encode($current_poll) }}" :history="{{ json_encode($history) }}"/>
</div>
<script 
      type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-VilpzLr9ufCPFYZN"
></script>
<script type="text/javascript">
function pay()
{
	let parameter = {
	  "transaction_details": {
	      "poll_id": "{!! $current_poll['poll']->id !!}",
	      "gross_amount": 10
	  },
	};
	snap.createTransaction(parameter)
	  .then((transaction)=>{
	      // transaction token
	      var transactionToken = transaction.token;
	      console.log('transactionToken:',transactionToken);
	      snap.pay(transactionToken);
	})
}
</script>
@endsection
