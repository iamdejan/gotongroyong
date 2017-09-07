@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sumbangan yang Sudah Anda Berikan</div>

                <div class="panel-body">
                    @foreach($donations as $donation)
                        <h3><a href="{{ url('/project').'/'.$donation->campid }}">{{ App\Campaign::findOrFail($donation->campid)->select("title")->first()["title"] }}</a></h3>
                        Waktu: {{ $donation->created_at }}<br />
                        Jumlah Donasi: {{ showMoney($donation->amount) }}<br />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
