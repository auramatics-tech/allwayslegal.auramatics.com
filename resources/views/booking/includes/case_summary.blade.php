<div class="row">
    <div class="col-12">
        <p class="mb-0"><em>Share important info with your
                lawyers. Concise notes work best.</em></p>
    </div>

    <div class="col-md-12 mb-3 @if (Auth::check()) d-none @endif">
        <label for="client_name">Name<span class="text-danger">*</span></label>
        <input name="client_name" placeholder="Name" type="text"
            class="required form-control @error('client_name') is-invalid @enderror"
            value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
        @error('client_name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-12 mb-3 @if (Auth::check()) d-none @endif">
        <label for="client_email">Email<span class="text-danger">*</span></label>
        <input name="client_email" placeholder="Email" type="email"
            class="required form-control @error('client_email') is-invalid @enderror"
            value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
        @error('client_email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="case_title">Case Title<span class="text-danger">*</span></label>
        <input name="case_title" placeholder="Case Title" type="text"
            class="required form-control @error('case_title') is-invalid @enderror" value="" required>
        @error('case_title')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="last-name">Add your notes<span class="text-danger">*</span></label>
        <textarea name="case_note" placeholder="Add your case notes/summary..." type="text" rows="5"
            class="required form-control @error('case_note') is-invalid @enderror" required></textarea>
        @error('case_note')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="last-name">Case File<span class="text-danger">*</span></label>
        <input name="case_file" placeholder="Case File" type="file"
            class="required form-control @error('case_note') is-invalid @enderror" value="" required>
        @error('case_file')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="example mt-3 p-4 border" style="background:ghostwhite; border-radius:5px; color:gray">
            <h5 style="color:#337ab7"><i class="fa fa-question-circle"></i> Example</h5>
            <p class="mt-0">
                <small>
                    My business partner and I have spent the last six months developing a computer
                    program that helps
                    restaurant managers manage their inventory. We want to commercialize this
                    program,
                    but we are unsure about some few things.
                    <ol>
                        <li>How do we protect our intellectual property from our competitors?</li>
                        <li>Do we need to register a patent or a copyright?</li>
                        <li>What happens if our relationship falls apart?</li>
                        <li>Who would own the program in case of a split?</li>
                        <li>How would the revenue be split if we split?</li>
                    </ol>
                </small>
            </p>
        </div>
    </div>

    <div class="mt-3 d-grid gap-1 d-flex justify-content-md-end">
        <div class="btn-style py-2"><button type="button" class="btn-sm ms-auto py-1 px-3" id="next_legal">Next<i
                    class="fa fa-chevron-right ms-2"></i></button></div>
    </div>
</div>
