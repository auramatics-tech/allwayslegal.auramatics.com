@extends('templates.main')
@section('content')

@include('lawyer.template.header')

<div class="container mt-3">
    <form action="{{ route('lawyer.appointment.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
            Choose Date
            </div>
            <div class="card-body">      
                <div class="row form-group">
                    <!-- <label for="date" class="col-sm-1 col-form-label">Date</label> -->
                    <div class="col-sm-12">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" placeholder="Enter date here"
                            name="date">
                            <span class="input-group-append">
                                <span class="input-group-text bg-black d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                Choose AM time       
                <span class="container mt-3" style="margin-left:700px">Check/Uncheck
                <input type="checkbox" onclick="for(c in document.getElementsByName('time[]')) 
                    document.getElementsByName('time[]').item(c).checked=this.checked">
                </span>
            </div>      
                
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr><th scope="row">1</th>
                            <td><input type="checkbox" name="time[]" value="6:00am"> 6:00</td>
                            <td><input type="checkbox" name="time[]" value="6:20am"> 6:20</td>
                            <td><input type="checkbox" name="time[]" value="6:40am"> 6:40</td>
                        </tr>
                        <tr><th scope="row">2</th>
                            <td><input type="checkbox" name="time[]" value="7:00am"> 7:00</td>
                            <td><input type="checkbox" name="time[]" value="7:20am"> 7:20</td>
                            <td><input type="checkbox" name="time[]" value="7:40am"> 7:40</td>
                        </tr>
                        <tr><th scope="row">3</th>
                            <td><input type="checkbox" name="time[]" value="8:00am"> 8:00</td>
                            <td><input type="checkbox" name="time[]" value="8:20am"> 8:20</td>
                            <td><input type="checkbox" name="time[]" value="8:40am"> 8:40</td>
                        </tr>
                        <tr><th scope="row">4</th>
                            <td><input type="checkbox" name="time[]" value="9:00am"> 9:00</td>
                            <td><input type="checkbox" name="time[]" value="9:20am"> 9:20</td>
                            <td><input type="checkbox" name="time[]" value="9:40am"> 9:40</td>
                        </tr>
                        <tr><th scope="row">5</th>
                            <td><input type="checkbox" name="time[]" value="10:00am"> 10:00</td>
                            <td><input type="checkbox" name="time[]" value="10:20am"> 10:20</td>
                            <td><input type="checkbox" name="time[]" value="10:40am"> 10:40</td>
                        </tr>
                        <tr><th scope="row">6</th>
                            <td><input type="checkbox" name="time[]" value="11:00am"> 11:00</td>
                            <td><input type="checkbox" name="time[]" value="11:20am"> 11:20</td>
                            <td><input type="checkbox" name="time[]" value="11:40am"> 11:40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                Choose PM time
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr><th scope="row">7</th>
                            <td><input type="checkbox" name="time[]" value="12:00pm"> 12:00</td>
                            <td><input type="checkbox" name="time[]" value="12:20pm"> 12:20</td>
                            <td><input type="checkbox" name="time[]" value="12:40pm"> 12:40</td>
                        </tr>
                        <tr><th scope="row">8</th>
                            <td><input type="checkbox" name="time[]" value="1:00pm"> 1:00</td>
                            <td><input type="checkbox" name="time[]" value="1:20pm"> 1:20</td>
                            <td><input type="checkbox" name="time[]" value="1:40pm"> 1:40</td>
                        </tr>
                        <tr><th scope="row">9</th>
                            <td><input type="checkbox" name="time[]" value="2:00pm"> 2:00</td>
                            <td><input type="checkbox" name="time[]" value="2:20pm"> 2:20</td>
                            <td><input type="checkbox" name="time[]" value="2:40pm"> 2:40</td>
                        </tr>
                        <tr><th scope="row">10</th>
                            <td><input type="checkbox" name="time[]" value="3:00pm"> 3:00</td>
                            <td><input type="checkbox" name="time[]" value="3:20pm"> 3:20</td>
                            <td><input type="checkbox" name="time[]" value="3:40pm"> 3:40</td>
                        </tr>
                        <tr><th scope="row">12</th>
                            <td><input type="checkbox" name="time[]" value="4:00pm"> 4:00</td>
                            <td><input type="checkbox" name="time[]" value="4:20pm"> 4:20</td>
                            <td><input type="checkbox" name="time[]" value="4:40pm"> 4:40</td>
                        </tr>
                        <tr><th scope="row">13</th>
                            <td><input type="checkbox" name="time[]" value="5:00pm"> 5:00</td>
                            <td><input type="checkbox" name="time[]" value="5:20pm"> 5:20</td>
                            <td><input type="checkbox" name="time[]" value="5:40pm"> 5:40</td>
                        </tr>
                        <tr><th scope="row">14</th>
                            <td><input type="checkbox" name="time[]" value="6:00pm"> 6:00</td>
                            <td><input type="checkbox" name="time[]" value="6:20pm"> 6:20</td>
                            <td><input type="checkbox" name="time[]" value="6:40pm"> 6:40</td>
                        </tr>
                        <tr><th scope="row">15</th>
                            <td><input type="checkbox" name="time[]" value="7:00pm"> 7:00</td>
                            <td><input type="checkbox" name="time[]" value="7:20pm"> 7:20</td>
                            <td><input type="checkbox" name="time[]" value="7:40pm"> 7:40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3 mb-3 -3 text-center">
            <div class="card-body">
                <a href="{{ route('lawyer.appointment.index') }}" class="col-2 btn btn-secondary" type="submit">Back</a>
                <button class="col-2 btn btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>
</div> 

<style type="text/css">
    input[type="checkbox"] {
        zoom:1.5;
    }
    body {
        font-size:20px;
    }
</style>

@endsection