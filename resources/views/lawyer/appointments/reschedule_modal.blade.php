  <!-- The Modal -->
  <div class="modal" id="rescheduleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('lawyer.appointment.check') }}" method="POST" id="reschedule_form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reschedule Appointment</h4>
                    <button type="button" class="close border-0 fs-4 bg-none"
                        data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body container">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="" class="mb-0">Date</label>
                            <input type="date" name="date" id="reschedule_date" min="{{date('Y-m-d')}}"
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
                                class="col-12 form-control @error('start_time') is-invalid @enderror" required>
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="" class="mb-0">End Time</label>
                            <input type="time" name="end_time"
                                class="col-12 form-control @error('end_time') is-invalid @enderror" required>
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