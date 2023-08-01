@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('lawyer.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width right_width">
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
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Add <i class="fa fa-plus-circle"></i>
                    </button>
                    <h5 class="text-left d-flex" style="float:right">Total:
                        <div class="ms-2">
                            <div style="background:#337ab7;border-radius:50%;padding:5px;color:#fff;width: 28px; height:28px;"
                                class="d-flex align-items-center justify-content-center">
                                {{ $schedules->total() }}</div>
                        </div>
                    </h5>
                </div>
                <div style="width:100%; height:100%; white-space: nowrap; overflow-x: auto">
                    <table class="table table-striped table-bordered text-center schedules_table">
                        <thead style="background:#337ab7; color:#fff">
                            <tr>
                                <th scope="col">Sn.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Start time</th>
                                <th scope="col">End time</th>
                                <th scope="col">Created On</th>
                                <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $key => $schedule)
                                <tr>
                                    <th scope="row">{{ $schedules->firstItem() + $key }}</th>
                                    <td>{{ date_format($schedule->date, 'd/m/Y') }}</td>
                                    <td>{{ date_format($schedule->start_time, 'H:i:s') }}</td>
                                    <td>{{ date_format($schedule->end_time, 'H:i:s') }}</td>
                                    <td>{{ date_format($schedule->created_at, 'd/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="d-flex gap-3 justify-content-center">
                                            <a class="btn btn-sm btn-secondary text-light edit_schedule" href="javascript:"
                                                role="button" data-id="{{ $schedule->id }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('delete-schedule-{{ $schedule->id }}').submit()">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-schedule-{{ $schedule->id }}"
                                                action="{{ route('lawyer.delete_schedule', $schedule->id) }}"
                                                method="POST" style="display:none">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $schedules->links() }}</div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('lawyer.save_schedule') }}" method="POST">
                                @csrf
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Schedule</h4>
                                    <button type="button" class="close border-0 fs-4 bg-none"
                                        data-bs-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body container">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label for="" class="mb-0">Date</label>
                                            <input type="date" name="date" id="edit_date" min="{{date('Y-m-d') }}"
                                                class="col-12 form-control @error('date') is-invalid @enderror">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="" class="mb-0">Start Time</label>
                                            <input type="time" name="start_time"
                                                class="col-12 form-control @error('start_time') is-invalid @enderror">
                                            @error('start_time')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="" class="mb-0">End Time</label>
                                            <input type="time" name="end_time"
                                                class="col-12 form-control @error('end_time') is-invalid @enderror">
                                            @error('end_time')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="lawyer_id" value="{{ Auth::user()->lawyer->id }}">
                                        <input type="hidden" name="id" value="">
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    // Form submit event listener
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        var startTime = $('#edit_date').val() + ' ' + $('input[name="start_time"]').val();
        var endTime = $('#edit_date').val() + ' ' + $('input[name="end_time"]').val();

        if (startTime >= endTime) {
            alert('End time must be greater than start time.');
            return;
        }

        // If validation passes, submit the form
        this.submit();
    });
});
</script>
    <script>
        $(document).on('click', '.edit_schedule', function() {
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('lawyer/edit-schedule') }}/" + id,
                method: "get",
                success: function(data) {
                    var date = new Date(data.date);
                    var formattedDate = date.toISOString().split('T')[0];
                    $("input[name='date']").val(formattedDate);

                    var StartTime = data.start_time;
                    var timeParts = StartTime.split("T")[1].split(":");
                    var hours = timeParts[0];
                    var minutes = timeParts[1];
                    
                    var EndTime = data.end_time;
                    var timeParts = EndTime.split("T")[1].split(":");
                    var hours1 = timeParts[0];
                    var minutes1 = timeParts[1];

                    var formattedStartTime = hours + ":" + minutes;
                    $("input[name='start_time']").val(formattedStartTime);

                    var formattedEndTime = hours1 + ":" + minutes1;
                    $("input[name='end_time']").val(formattedEndTime);

                    $("input[name='id']").val(data.id);

                    $('#myModal').modal("show");
                }
            })
        })
    </script>
@endsection