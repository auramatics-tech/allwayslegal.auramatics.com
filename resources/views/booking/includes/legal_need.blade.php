<div class="col-12">
    <p><em>Start by selecting a legal category so we can find you the right lawyers.</em></p>
</div>
<div class="card mb-4 default_card shadow-sm">
    <p class="fs-25px dark-blue-color"><b>Your legal needs</b></p>
    <div class="row">
        <div class="col-md-6">
            <select class="form-select" aria-label="Default select example" id="area_select" name="area_id">
                <option selected>Select practice area</option>
                @if (count($areas))
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" data-name="{{ $area->name }}">{{ $area->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-6 mt-md-0 mt-3">
            <select class="form-select" aria-label="Default select example" id="services_select" name="service_id">
                <option selected>Choose a Service</option>
            </select>
        </div>
    </div>
</div>
<div id="lawyer_div"></div>
<input type="hidden" name="area_name" id="area_name">
<input type="hidden" name="service_title" id="service_title">

