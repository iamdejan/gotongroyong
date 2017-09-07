@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mulai Kampanye Baru</div>

                <div class="panel-body">
                    @if(isset($message))
                        {!! $message."<br />" !!}
                    @endif
                    <form method="post" action="{{ route('simpan') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Judul Kampanye</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('story') ? ' has-error' : '' }}">
                            <label for="story" class="col-md-4 control-label">Cerita Singkat</label>

                            <div class="col-md-6">
                                <textarea id="story" name="story">Masukkan cerita singkat.</textarea>

                                @if ($errors->has('story'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('story') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fund') ? ' has-error' : '' }}">
                            <label for="fund" class="col-md-4 control-label">Dana yang Dibutuhkan (Rupiah)</label>

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
