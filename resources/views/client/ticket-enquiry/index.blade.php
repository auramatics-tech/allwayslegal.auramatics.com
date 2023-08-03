@extends('layouts.dashboard')
@section('content')
    <style>
        .appointment_table tbody tr:nth-of-type(even) th,
        .appointment_table tbody tr:nth-of-type(even) td {
            background: rgba(255, 255, 255, 0.5) !important;
            box-shadow: inset 0 0 0 9999px rgba(241, 241, 241, 0.5);
        }

        .relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none;
        }
    </style>

    <div class="py-4 right_width">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h4 class="mb-3" style="color:#337ab7;">Ticket Enquiry</h4>
            <div style="padding: 5px;">
                <a href="{{ route('client.ticket_enquiry_create') }}" type="button" class="btn btn-primary">
                    Add <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>

        <div style="width:100%; height:100%; white-space: nowrap; overflow-x: auto">
            <div class="col-md-12">
                <table class="table table-striped table-bordered text-center schedules_table">
                    <thead style="background:#337ab7; color:#fff">
                        <tr>
                            <th scope="col">Sn.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $key => $ticket)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ isset($ticket->title) ? $ticket->title : '' }}</td>
                                    <td>{{ isset($ticket->description) ? $ticket->description : '' }}</td>
                                    <td>
                                        @if ($ticket->status == 2)
                                            <span class="text-success">Completed</span>
                                        @elseif($ticket->status == 1)
                                            <span class="text-danger">In-progress</span>
                                        @else
                                            <span class="text-danger">Requested</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex;gap:12px; align-items:center;justify-content:center">
                                            <div
                                                style="display: flex;gap:12px; align-items:center;justify-content:center d-inline-flex">
                                                <a href="{{ route('client.join_chat_client', base64_encode($ticket->id)) }}"
                                                    class="btn" style="background:#337ab7;color:#fff"><b><i
                                                            class="fa fa-reply"></i></b></a>
                                                @php $ticketMessageCount = getTicketMessageCount($ticket->id); @endphp
                                                @if (!empty($ticketMessageCount))
                                                    <span
                                                        class="badge rounded-pill bg-warning ms-1">{{ $ticketMessageCount }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
