@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-info text-uppercase">Customer Tickets</div>

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Reference</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            @foreach ($tickets as $key=> $ticket)
                                <tr class="{{$ticket->response == null ? 'text-danger':''}}">
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->customer_name }}</td>
                                    <td>{{ $ticket->reference }}</td>
                                    <td>
                                        <a href="/view-ticket/{{$ticket->id}}">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal">
                                                <i class="fa fa-eye">
                                                    View
                                                </i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
