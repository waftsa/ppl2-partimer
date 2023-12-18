<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('assets/css/company.css') }}">
  <!-- Add other necessary stylesheets and scripts here -->
</head>
<body>

@extends('Layout/company')


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
  <br><br>
  <p >Nama Pekerjaan</p>
  <div class="input-group">
    <input type="text" class="form-control" name="jobName" aria-describedby="fnHelp">
  </div>

  <p>Kategori</p>
  <div class="input-group">
  <select class="form-select" id="inputCategory" name="kategori">
    <option selected>Pilih...</option>
    <option value="IT">IT</option>
    <option value="Busines">Business</option>
    <option value="Cook">Cook</option>
    <option value="Retail">Retail</option>
  </select>
</div>

<p>Jangkauan Gaji</p>
  <div class="input-group">
    <input type="text" class="form-control" name="salary" aria-describedby="emailHelp">
  </div>

  <span>Deskripsi Pekerjaan</span>
  <div class="input-group">
  <textarea class="form-control" name="jobDesc" aria-label="With textarea"></textarea>
</div>

<span>Requirement Pekerjaan</span>
<div class="input-group">
  <textarea class="form-control" name="jobReq" aria-label="With textarea"></textarea>
</div>

<p>Status</p>
<div class="input-group">
  <select class="form-select" id="inputStatus" name="status">
    <option selected>Pilih...</option>
    <option value="Open">Open</option>
    <option value="Close">Close</option>
  </select>
</div>
<div class="submit">
  <button type="submit" class="submit">Buat Lowongan</button>
</div>
</form>
    </div>
</body>