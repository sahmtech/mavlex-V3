@extends('layouts.app')
@section('title', 'SMS History')

@section('content')

<div class="main-container no-print">
    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>SMS History</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">


    <div class="row">
        <div class="col-md-12">
            @if($results['status'] == false)
                <br>
                <div class="alert alert-danger">
                    <span>{{ $results['message'] }}</span>
                </div>
            @else
            <div class="table-responsive">
                <table class="report-table" id="sms_history_table">
                    <thead>
                        <tr>
                            <th>Sender ID</th>
                            <th>Contact</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($results['data'] as $data)
                            <tr>
                                <td>{{ $data['senderID'] }}</td>
                                <td>{{ $data['contacts'] }}</td>
                                <td>{{session('currency')['symbol'] ?? ''}} {{ @num_format($data['cost'] + $data['profit']) }}</td>
                                <td>
                                    @if($data['status'] == 'Processing')
                                        <span class="text-warning">{{ $data['status'] }}</span>
                                    @else
                                        <span class="text-success">{{ $data['status'] }}</span>
                                    @endif
                                </td>
                                <td>{{ @format_date($data['created_at']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
        </div>
    </div>
</div>

@endsection