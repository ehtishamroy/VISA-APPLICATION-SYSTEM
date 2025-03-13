@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.candidate.title_singular') }}
                </div>

                <div class="card-body">
                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Add Candidate Form -->
                    <form action="{{ route('admin.candidates.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="father_name">Father Name:</label>
                            <input type="text" name="father_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_name">Mother Name:</label>
                            <input type="text" name="mother_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="passport_number">Passport Number:</label>
                            <input type="text" name="passport_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cnic_number">CNIC Number:</label>
                            <input type="text" name="cnic_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_country">Applied Country:</label>
                            <input type="text" name="applied_country" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_company">Applied Company:</label>
                            <input type="text" name="applied_company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_position">Applied Position:</label>
                            <input type="text" name="applied_position" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection