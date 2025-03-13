<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    // Display the data entry form
    public function create()
    {
        return view('candidates.create'); // We'll create this view next
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

        return redirect()->route('candidates.create')->with('success', 'Candidate added successfully!');
    }

    // Display a list of candidates (for Dialer, Accountant, etc.)
    public function index()
    {
        $candidates = Candidate::all();
        return view('candidates.index', compact('candidates'));
    }

    // Update test status (for Instructor)
    public function updateTestStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'test_status' => 'required|in:Pass,Fail',
        ]);

        $candidate->update(['test_status' => $request->test_status]);

        return redirect()->route('candidates.index')->with('success', 'Test status updated successfully!');
    }

    // Update payment status (for Accountant)
    public function updatePaymentStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'payment_status' => 'required|in:Paid,Unpaid',
        ]);

        $candidate->update(['payment_status' => $request->payment_status]);

        return redirect()->route('candidates.index')->with('success', 'Payment status updated successfully!');
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

        return redirect()->route('candidates.index')->with('success', 'CV and Visa status updated successfully!');
    }
}