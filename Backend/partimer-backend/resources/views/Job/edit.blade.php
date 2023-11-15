@extends('Layout/layout')

@section('content')
<div class="container">
    <form action="{{ route('job.update',['job' => $job]) }}" method="POST">
        @csrf
        @method('put')
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <head>
  <script src="jquery-1.12.0.min.js"></script>
        
        <script>
        
        $(function() {
        
            // run on change for the selectbox
            $( "#inputCategory" ).change(function() {  
                updateCategory();
            });
            
            // handle the updating of the duration divs
            function updateCategory() {
                // hide all form-duration-divs
                //$('.form-duration-div').hide();
                  
                var category = $( "#inputCategory option:selected" ).val();                
                //$('#divFrm'+divKey).show();
            }        
        
            // run at load, for the currently selected div to show up
            updateCategory();
        
        });
        </script>
  </head>

  <h1>Form Lowongan Pekerjaan</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nama Pekerjaan</label>
    <input type="text" class="form-control" name="jobName" value="{{$job->jobName}}">
  </div>
  <div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
  <select class="form-select" id="inputCategory" name="kategori" value="{{$job->Category}}">
    <option selected> {{$job->Category}} </option>
    <option value="Waitres">Waitres</option>
    <option value="Delivery">Delivery</option>
    <option value="Cook">Cook</option>
  </select>
</div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Jangkauan Gaji</label>
    <input type="text" class="form-control" name="salary" value="{{$job->Salary}}">
  </div>
  <div class="input-group mb-3">
  <span class="input-group-text">Deskripsi Pekerjaan</span>
  <textarea class="form-control" name="jobDesc" value="{{$job->jobDesc}}">{{$job->jobDesc}}</textarea>
</div>
<div class="input-group mb-3">
  <span class="input-group-text">Requirement Pekerjaan</span>
  <textarea class="form-control" name="jobReq" value="{{$job->requirement}}">{{$job->requirement}}</textarea>
</div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
    </div>
@endsection