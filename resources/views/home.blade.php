@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card" style="width: 80%">
            <a href='/polls' class="btn btn-primary">
            Lihat semua poll 		
            </a>
        <div class="card-header text-center">
            New Polls
        </div>
                <div class="card-body">
            <script>
                
            </script>
            <form action="/polls" method="POST">
                @csrf
                 <div class="form-group">
                    <label for="judul">Judul Poll</label>
                    <input type="text" class="form-control" id="judul" placeholder="Masukkan judul" name="title">
                  </div>
                <div class="form-group">
                    <label for="pilihan-vote">Pilihan vote</label>
                      <button class="btn btn-outline-success" type="button" onclick="
                        document.getElementById('pilihan-vote')
                            .insertAdjacentHTML('beforeend', 
                            `<input type=text class=form-control placeholder='Pilihan vote' name=choice[]>`)"
                            >+</button>
                      <button class="btn btn-outline-danger" type="button" onclick="document.getElementById('pilihan-vote').childNodes[document.getElementById('pilihan-vote').childNodes.length-1].remove()">-</button>
                  <div id="pilihan-vote">
                    <input type="text" class="form-control" placeholder="Pilihan vote" name="choice[]">
                  </div>
                  </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>
                </div>
            </div>
    </div>
</div>
@endsection
