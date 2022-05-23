@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class=" btn btn-group">
                             <button type="button" style="float: left;" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              PROJECTS
                            </button>
                            
                   <ul class="dropdown-menu">
                    @if($projects->count() > 0)
                    @foreach($projects as $project)
                    <li><a class="dropdown-item" href="/project/{{$project->id}}">{{$project->name}}</a></li>
                    @endforeach
                    @else
                                   <tr>
                                        <td colspan="4" style="text-align: center;"><small>No Project Found</small></td>
                    @endif           </tr>
                  </ul>

                   
              </div>

              <button type="button" class="btn btn-secondary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Project
              </button>
             </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            
            </div>
             
                         
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
                             <div class="toast p-2 col-4" style="position:absolute; top:60; right:10;" data-autohide="false">
                                <div class="toast-body">
                                    <button type="" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-bs-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div>
                                      <img src="\icons\s1.png" style="height:30px">
                                         <span class="text-success font-weight-bold f3"> 
                                         <strong>{{ $message }}</strong>
                                         </span>
                                    </div>
                                </div>
                             </div>
                            @endif
                            @if ($message = Session::get('error'))
                            <div class="toast p-2 col-4" style="position:absolute; top:60; right:10;" data-autohide="false">
                                <div class="toast-body">
                                    <button type="" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-bs-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div>
                                      <img src="\icons\error.png" style="height:50px;">
                                         <span class="text-danger font-weight-bold f2"> 
                                         <strong>{{ $message }}</strong>
                                         </span>
                                    </div>
                                </div>
                            </div>        
                            @endif
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/home">
         @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Project</button>
                            </div>
                            </div>
                        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('.toast').toast('show');
});
</script>
@endsection
