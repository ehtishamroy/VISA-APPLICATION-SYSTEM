@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.candidate.title_singular') }} {{ trans('global.detail') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Personal Information</h5>
                            <hr>
                            <p><strong>Random ID:</strong> {{ $candidate->random_id }}</p>
                            <p><strong>Name:</strong> {{ $candidate->name }}</p>
                            <p><strong>Father Name:</strong> {{ $candidate->father_name }}</p>
                            <p><strong>Mother Name:</strong> {{ $candidate->mother_name }}</p>
                            <p><strong>Passport Number:</strong> {{ $candidate->passport_number }}</p>
                            <p><strong>CNIC Number:</strong> {{ $candidate->cnic_number }}</p>
                            <p><strong>Age:</strong> {{ $candidate->age }}</p>
                            <p><strong>City:</strong> {{ $candidate->city }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Job Application Details</h5>
                            <hr>
                            <p><strong>Applied Country:</strong> {{ $candidate->applied_country }}</p>
                            <p><strong>Applied Company:</strong> {{ $candidate->applied_company }}</p>
                            <p><strong>Applied Position:</strong> {{ $candidate->applied_position }}</p>
                            <p><strong>Test Status:</strong> {{ $candidate->test_status }}</p>
                            <p><strong>Payment Status:</strong> {{ $candidate->payment_status }}</p>
                            <p><strong>CV Status:</strong> {{ $candidate->cv_status }}</p>
                            <p><strong>Visa Status:</strong> {{ $candidate->visa_status }}</p>
                            <p><strong>Remarks:</strong> {{ $candidate->remarks }}</p>
                          <!-- Add CV Download Link -->
                          @if($candidate->cv_file_path)
                          <p><strong>Download CV:</strong>
                              <a href="{{ asset('storage/' . $candidate->cv_file_path) }}" class="btn btn-info" target="_blank">
                                  Download CV
                              </a>
                          </p>
                      @else
                          <p>No CV uploaded.</p>
                      @endif
                  </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection