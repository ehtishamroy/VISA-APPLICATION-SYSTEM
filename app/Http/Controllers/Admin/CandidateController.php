<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    // Display the data entry form
    public function create()
    {
        return view('admin.candidates.create'); // We'll create this view next
    }

    // Store candidate data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255|unique:candidates',
            'cnic_number' => 'required|string|max:255|unique:candidates',
            'age' => 'required|integer|min:18',
            'city' => 'required|string|max:255',
            'applied_country' => 'required|string|max:255',
            'applied_company' => 'required|string|max:255',
            'applied_position' => 'required|string|max:255',
        ]);

        Candidate::create($request->all());

        return redirect()->route('admin.candidates.create')->with('success', 'Candidate added successfully!');
    }

    // Display a list of candidates (for Dialer, Accountant, etc.)
    public function index(Request $request)
    {
        $candidates = Candidate::query();
    
        // Apply filters
        if ($request->has('position') && $request->position != '') {
            $candidates->where('applied_position', 'like', '%' . $request->position . '%');
        }
        if ($request->has('country') && $request->country != '') {
            $candidates->where('applied_country', 'like', '%' . $request->country . '%');
        }
        if ($request->has('cnic') && $request->cnic != '') {
            $candidates->where('cnic_number', 'like', '%' . $request->cnic . '%');
        }
        if ($request->has('payment_status') && $request->payment_status != '') {
            $candidates->where('payment_status', $request->payment_status);
        }
        if ($request->has('test_status') && $request->test_status != '') {
            $candidates->where('test_status', $request->test_status);
        }
        if ($request->has('date') && $request->date != '') {
            $candidates->whereDate('created_at', $request->date);
        }
        if ($request->has('visa_status') && $request->visa_status != '') {
            $candidates->where('visa_status', $request->visa_status);
        }
        if ($request->has('cv_status') && $request->cv_status != '') {
            $candidates->where('cv_status', $request->cv_status);
        }
    
        $candidates = $candidates->get();
    
        return view('admin.candidates.index', compact('candidates'));
    }
// Display the edit form
public function edit(Candidate $candidate)
{
    return view('admin.candidates.edit', compact('candidate'));
}

// Update candidate data
public function update(Request $request, Candidate $candidate)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'mother_name' => 'required|string|max:255',
        'passport_number' => 'required|string|max:255|unique:candidates,passport_number,' . $candidate->id,
        'cnic_number' => 'required|string|max:255|unique:candidates,cnic_number,' . $candidate->id,
        'age' => 'required|integer|min:18',
        'city' => 'required|string|max:255',
        'applied_country' => 'required|string|max:255',
        'applied_company' => 'required|string|max:255',
        'applied_position' => 'required|string|max:255',
    ]);

    $candidate->update($request->all());

    return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully!');
}
    // Update test status (for Instructor)
    public function updateTestStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'test_status' => 'required|in:Pass,Fail',
        ]);

        $candidate->update(['test_status' => $request->test_status]);

        return redirect()->route('admin.candidates.index')->with('success', 'Test status updated successfully!');
    }
    public function show(Candidate $candidate)
{
    return view('admin.candidates.show', compact('candidate'));
}

    // Update payment status (for Accountant)
    public function updatePaymentStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'payment_status' => 'required|in:Paid,Unpaid',
        ]);

        $candidate->update(['payment_status' => $request->payment_status]);

        return redirect()->route('admin.candidates.index')->with('success', 'Payment status updated successfully!');
    }

    // Update CV and Visa status (for CV Loader)
    public function updateCvVisaStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'cv_status' => 'required|in:Not Submitted,Submitted',
            'visa_status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $candidate->update([
            'cv_status' => $request->cv_status,
            'visa_status' => $request->visa_status,
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'CV and Visa status updated successfully!');
    }
}