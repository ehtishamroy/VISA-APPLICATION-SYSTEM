@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.candidate.title_singular') }}
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="father_name">Father Name:</label>
                            <input type="text" name="father_name" class="form-control" value="{{ $candidate->father_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_name">Mother Name:</label>
                            <input type="text" name="mother_name" class="form-control" value="{{ $candidate->mother_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="passport_number">Passport Number:</label>
                            <input type="text" name="passport_number" class="form-control" value="{{ $candidate->passport_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="cnic_number">CNIC Number:</label>
                            <input type="text" name="cnic_number" class="form-control" value="{{ $candidate->cnic_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" class="form-control" value="{{ $candidate->age }}" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" class="form-control" value="{{ $candidate->city }}" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_country">Applied Country:</label>
                            <input type="text" name="applied_country" class="form-control" value="{{ $candidate->applied_country }}" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_company">Applied Company:</label>
                            <input type="text" name="applied_company" class="form-control" value="{{ $candidate->applied_company }}" required>
                        </div>
                        <div class="form-group">
                            <label for="applied_position">Applied Position:</label>
                            <input type="text" name="applied_position" class="form-control" value="{{ $candidate->applied_position }}" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection