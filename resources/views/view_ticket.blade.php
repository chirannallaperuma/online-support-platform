@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">
                            View Ticket
                            <a href="{{route('home')}}">
                                <button type="button" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-list">
                                        Ticket List
                                    </i>
                                </button>
                            </a>
                        </div>
                    </div>
                    @if (session('alert'))
                        <div class="alert alert-success">
                            <button type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                            </button>
                            {{ session('alert') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('ticket.update') }}">
                            @csrf
                            <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
                            <div class="form-group row">
                                <label for="reference" class="col-md-4 col-form-label text-md-right">Reference</label>

                                <div class="col-md-6">
                                    <input id="reference" type="text"
                                           class="form-control"
                                           name="reference" value="{{ $ticket->reference }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="customer_name" class="col-md-4 col-form-label text-md-right">Customer
                                    Name</label>

                                <div class="col-md-6">
                                    <input id="customer_name" type="text"
                                           class="form-control"
                                           name="customer_name" value="{{ $ticket->customer_name }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">Problem Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text"
                                              class="form-control"
                                              name="description" disabled>{{ $ticket->description }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control"
                                           name="email" value="{{ $ticket->email }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control"
                                           name="phone" value="{{ $ticket->phone }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="response" class="col-md-4 col-form-label text-md-right">Response</label>
                                <div class="col-md-6">
                                        <textarea id="response" type="text"
                                                  class="form-control"
                                                  name="response"
                                        {{$ticket->response !=null ? 'disabled': ''}}>{{ $ticket->response }}
                                        </textarea>
                                </div>
                            </div>
                            @if ($ticket->response == null)
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update Ticket
                                        </button>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('div.alert').delay(2000).slideUp(300);
    </script>
@endsection
