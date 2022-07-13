@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-4">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Edit Details</h3>
                            <!-- <a class="btn btn-primary btn-sm mr-2" href="@yield('createRoute')">Add new</a> -->
                            <a class="btn btn-success" href="{{ route('students.index') }}"> Go back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
             
                    <!--- Form starts -->
                    <form action="{{ route('students.update',$student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name <small style="color:red">* </small> </label>
                                        <input type="text" id="name" name="name" required class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{ $student->name }}">
                                        @if($errors->has('name'))
                                            <span class="help-block error invalid-feedback">
                                                <strong>{{$errors->first('name')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="age" class="control-label">Age <small style="color:red">* </small> </label>
                                        <input type="text" id="age" name="age" required class="form-control {{$errors->has('age') ? 'is-invalid' : ''}}" value="{{ $student->age }}">
                                        @if($errors->has('age'))
                                            <span class="help-block error invalid-feedback">
                                                <strong>{{$errors->first('age')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gender" class="control-label"> Gender <small style="color:red;">*</small></label><br/>
                                        <div class="ml-3">
                                            <input type="radio" id="male" name="gender"  @if($student->gender =='M') checked @endif value="M" class="form-check-inline" required ><label class="form-check-label" for="male"> Male </label> 
                                            <input type="radio" id="female" name="gender" value="F"  @if($student->gender =='F') checked @endif class="form-check-inline" ><label class="form-check-label" for="female"> Female </label>
                                                @if($errors->has('gender'))
                                                <span class="help-block error invalid-feedback">
                                                    <strong>{{$errors->first('gender')}}</strong>
                                                </span>
                                                @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="teacher_id"> Reporting Teacher <small style="color:red;">*</small> </label>
                                        <select id="user_type" name="teacher_id" required class="form-control">
                                        <option value="" > -- Select Teacher-- </option>
                    
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" @if($student->teacher_id == $teacher->id) selected @endif >{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                            <a href="{{ route('students.store') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection