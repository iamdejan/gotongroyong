@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Kampanye Terbaru</div>

                <div class="panel-body">
                    @foreach($campaigns as $campaign)
                        <h3><a href="{{ url('/project').'/'.$campaign->id }}">{{ $campaign->title }}</a></h3>
                        Waktu: {{ $campaign->updated_at }}<br />
                        Keterangan:<br />
                        {{ substr($campaign->story, 0, 100)."..." }}
                        <br /><br />
                        Dana yang Diperlukan: {{ showMoney($campaign->actual_fund) }}<br />
                        Dana yang Terkumpul: {{ showMoney($campaign->collected) }}<br />
                        Oleh: {{ $campaign->usermail }}<br />
                    @endforeach

                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
