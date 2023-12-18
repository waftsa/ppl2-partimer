@extends('Layout/layout')

@section('content')
<div class="container">
    <form action="{{  route('job.store', ['company' => $company])  }}" method="POST">
        @csrf
        @method('post')
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

        <script>
        $(function() {
        
        // run on change for the selectbox
        $( "#inputStatus" ).change(function() {  
            updateStatus();
        });
        
        // handle the updating of the duration divs
        function updateStatus() {
            // hide all form-duration-divs
            //$('.form-duration-div').hide();
              
            var category = $( "#inputStatus option:selected" ).val();                
            //$('#divFrm'+divKey).show();
        }        
    
        // run at load, for the currently selected div to show up
        updateStatus();
    
    });
    </script>
  </head>

  <h1>Form Lowongan Pekerjaan</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nama Pekerjaan</label>
    <input type="text" class="form-control" name="jobName" aria-describedby="fnHelp">
  </div>

  <div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
  <select class="form-select" id="inputCategory" name="kategori">
    <option selected>Pilih...</option>
    <option value="IT">IT</option>
    <option value="Busines">Business</option>
    <option value="Cook">Cook</option>
    <option value="Retail">Retail</option>
  </select>
</div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Jangkauan Gaji</label>
    <input type="text" class="form-control" name="salary" aria-describedby="emailHelp">
  </div>
  <div class="input-group mb-3">
  <span class="input-group-text">Deskripsi Pekerjaan</span>
  <textarea class="form-control" name="jobDesc" aria-label="With textarea"></textarea>
</div>
<div class="input-group mb-3">
  <span class="input-group-text">Requirement Pekerjaan</span>
  <textarea class="form-control" name="jobReq" aria-label="With textarea"></textarea>
</div>
<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Status</label>
  <select class="form-select" id="inputStatus" name="status">
    <option selected>Pilih...</option>
    <option value="Open">Open</option>
    <option value="Close">Close</option>
  </select>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
@endsection