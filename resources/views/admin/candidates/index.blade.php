@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.candidate.title') }} {{ trans('global.list') }}

                    <!-- Add Candidate Button -->
                    @can('candidate_create')
                        <div class="float-right">
                            <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.candidate.title_singular') }}
                            </a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <form action="{{ route('admin.candidates.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="position">Applied Position:</label>
                                <input type="text" name="position" class="form-control" value="{{ request('position') }}" placeholder="Applied Position">
                            </div>
                            <div class="col-md-3">
                                <label for="country">Applied Country:</label>
                                <input type="text" name="country" class="form-control" value="{{ request('country') }}" placeholder="Applied Country">
                            </div>
                            <div class="col-md-3">
                                <label for="cnic">CNIC Number:</label>
                                <input type="text" name="cnic" class="form-control" value="{{ request('cnic') }}" placeholder="CNIC Number">
                            </div>
                            <div class="col-md-3">
                                <label for="payment_status">Payment Status:</label>
                                <select name="payment_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label for="test_status">Test Status:</label>
                                <select name="test_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="Pass" {{ request('test_status') == 'Pass' ? 'selected' : '' }}>Pass</option>
                                    <option value="Fail" {{ request('test_status') == 'Fail' ? 'selected' : '' }}>Fail</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="date">Date:</label>
                                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="visa_status">Visa Status:</label>
                                <select name="visa_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="Pending" {{ request('visa_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Accepted" {{ request('visa_status') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="Rejected" {{ request('visa_status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="cv_status">CV Status:</label>
                                <select name="cv_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="Not Submitted" {{ request('cv_status') == 'Not Submitted' ? 'selected' : '' }}>Not Submitted</option>
                                    <option value="Submitted" {{ request('cv_status') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.candidates.index') }}" class="btn btn-default">Reset</a>
                            </div>
                        </div>
                    </form>

                    <!-- Candidates Table -->
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Random ID</th>
                                <th>Name</th>
                                <th>Applied Country</th>
                                <th>Applied Position</th>
                                <th>Test Status</th>
                                <th>Payment Status</th>
                                <th>CV Status</th>
                                <th>Visa Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->random_id }}</td>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->applied_country }}</td>
                                    <td>{{ $candidate->applied_position }}</td>
                                    <td>
                                        @can('test_status_update')
                                            <form action="{{ route('admin.candidates.updateTestStatus', $candidate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="test_status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="Pass" {{ $candidate->test_status == 'Pass' ? 'selected' : '' }}>Pass</option>
                                                    <option value="Fail" {{ $candidate->test_status == 'Fail' ? 'selected' : '' }}>Fail</option>
                                                </select>
                                            </form>
                                        @else
                                            {{ $candidate->test_status }}
                                        @endcan
                                    </td>
                                    <td>
                                        @can('payment_status_update')
                                            <form action="{{ route('admin.candidates.updatePaymentStatus', $candidate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="payment_status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="Paid" {{ $candidate->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                    <option value="Unpaid" {{ $candidate->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                                </select>
                                            </form>
                                        @else
                                            {{ $candidate->payment_status }}
                                        @endcan
                                    </td>
                                    <td>
                                        @can('cv_status_update')
                                            <form action="{{ route('admin.candidates.updateCvVisaStatus', $candidate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="cv_status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="Not Submitted" {{ $candidate->cv_status == 'Not Submitted' ? 'selected' : '' }}>Not Submitted</option>
                                                    <option value="Submitted" {{ $candidate->cv_status == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                                                </select>
                                            </form>
                                        @else
                                            {{ $candidate->cv_status }}
                                        @endcan
                                    </td>
                                    <td>
                                        @can('visa_status_update')
                                            <form action="{{ route('admin.candidates.updateCvVisaStatus', $candidate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="visa_status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="Pending" {{ $candidate->visa_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Accepted" {{ $candidate->visa_status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                    <option value="Rejected" {{ $candidate->visa_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        @else
                                            {{ $candidate->visa_status }}
                                        @endcan
                                    </td>
                                    <td>
                                        @can('candidate_edit')
                                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="btn btn-sm btn-info">Show Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection