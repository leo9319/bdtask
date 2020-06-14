@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    @if(!$setting)
                    <a class="btn btn-success float-right" href="{{ route('settings.create') }}">Add Setting</a>
                    @endif
                </div>

                <form method="post" action="{{ route('settings.destroy_all') }}">
                    @method('DELETE')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Provident Fund percentage: </label>
                            <div class="col-sm-2">
                                <p>{{ $setting->provident_fund_percentage ?? 'Data Deleted' }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Revenue Share percentage: </label>
                            <div class="col-sm-2">
                                <p>{{ $setting->revenue_share_percentage ?? 'Data Deleted' }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Technical Team members: </label>
                            <div class="col-sm-2">
                                <p>{{ $setting->technical_team ?? 'Data Deleted' }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Insurance Premium: </label>
                            <div class="col-sm-2">
                                <p>{{ $setting->insurance_premium ?? 'Data Deleted' }}</p>
                            </div>
                        </div>

                        <div class="form-group row m-1">
                            <button class="btn btn-danger btn-block" type="submit">Delete All</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
