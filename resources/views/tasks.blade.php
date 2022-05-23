@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
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
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >
<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3><strong>All Tasks with Drag and Drop functionality here</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>All Tasks</strong></h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif


                        <div class="row mb-3">
                    
                        </div>
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr  style="text-align: center;">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>priority</th>
                                    <th>Timestamp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                             <tbody class ="" id="tablecontents">
                                @if($tasks->count() > 0)
                                    @foreach ($tasks as $task)
                
                                        <tr class="row1" data-id="{{ $task->id }}" style="text-align: center;">
  
    	                                    <td><i class="fas fa-sort"></i></td>
                                            <td>{{ $task->name }}</td>
                                            <td >{{ $task->priority }}</td>
                                            <td >{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td> 
                                            <td>

                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#task{{$task->id}}">
                                                  View
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editTask{{$task->id}}">
                                                 Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTask{{$task->id}}">
                                                 Delete
                                                </button>
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                 @else
                                
                                    <tr>
                                        <td colspan="4" style="text-align: center;"><small>No Task Found</small></td>
                                    </tr>
                                @endif
                             </tbody>
                            
                        </table>
                      
                    </div>
                </div>
                <h5  style="text-align: center;"><button class="btn btn-success btn-sm" onclick="window.location.reload()">UPDATE CHANGES</button></h5> 
            </div>
        </div>
    </div>


    <!-- Modal -->
@foreach ($tasks as $task)
<div class="modal fade" id="task{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Name: </th>
                                <td>{{ $task->name }}</td>
                            </tr>


                            <tr>
                                <th>Priority: </th>
                                <td>{{ $task->priority }}</td>
                            </tr>


                            <tr>
                                <th>Description </th>
                                <td>{{$task->description }}</td>
                            </tr>


                            <tr>
                                <th>Date: </th>
                                <td>{{ $task->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
      </div>
    </div>
  </div>
</div>
@endforeach
@foreach ($tasks as $task)
<!-- Modal -->
<div class="modal fade" id="editTask{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  method="POST" action="/tasks">
        @method('PATCH')
         @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 form-label text-md-end">Description</label>

                            <div class="col-md-6">
                                <input  id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $task->description }}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="priority" class="col-md-4 col-form-label text-md-end">Priority</label>

                            <div class="col-md-6">
                                <input id="priority" type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" value="{{ $task->priority }}" required autocomplete="priority" autofocus>

                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                            
                              <input id="project_id" type="hidden" class="form-control" name="project_id" value="{{ $task->project_id }}">

                                
                        
                                <input id="status" type="hidden" class="form-control" name="status" value="{{$task->status }}" required autocomplete="status" autofocus>
                                
                        <input type="hidden" id="id" name="id" value="{{$task->id}}">

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Update Task</button>
                            </div>
                            </div>
                        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@foreach($tasks as $task)
<div class="modal fade" id="deleteTask{{$task->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure? You want to delete this Task data!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary"  data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
                   <form method="post" action="/tasks"> 
                   @method('DELETE')
                   @csrf
                   <input type="hidden" id="id" name="id" value="{{$task->id}}">
                   <button class="btn btn-sm btn-danger" type="submit">Yes! Delete</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
      $(function () {
        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.8,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var priority = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            priority.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('tasks/priority') }}",
                data: {
                priority: priority,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
<script>
$(document).ready(function(){
  $('.toast').toast('show');
});
</script>
    
@endsection