@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ganti Kampanye</div>

                <div class="panel-body">
                    @if(isset($message))
                        {!! $message."<br />" !!}
                    @endif
                    <form method="post" action="{{ route('update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('campaign') ? ' has-error' : '' }}">
                            <label for="campaign" class="col-md-4 control-label">Pilih Kampanye</label>

                            <div class="col-md-6">
                                <select name="campaign" class="form-control">
                                    @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">{{ $campaign->id." - ".$campaign->title }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('campaign'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fund') ? ' has-error' : '' }}">
                            <label for="fund" class="col-md-4 control-label">Revisi Dana (Rupiah)</label>

                            <div class="col-md-6">
                                <input id="fund" type="text" class="form-control" name="fund" required autofocus>

                                @if ($errors->has('fund'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fund') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
