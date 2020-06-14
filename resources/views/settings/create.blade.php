@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Setting
                </div>

                <form method="post" action="{{ route('settings.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Provident Fund percentage: </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="provident_fund_percentage" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Revenue Share percentage: </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="revenue_share_percentage" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Technical Team members: </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="technical_team" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-10 col-form-label">Insurance Premium: </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="insurance_premium" required>
                            </div>
                        </div>

                        <div class="form-group row m-1">
                            <button class="btn btn-success btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
