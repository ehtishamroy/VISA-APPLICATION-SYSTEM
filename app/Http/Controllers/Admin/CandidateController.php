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
            'cv_file' => 'required|file|mimes:pdf,png|max:10240', // Max 10MB

        ]);
 
       

        // Store the CV file
        $filePath = $request->file('cv_file')->store('cvs', 'public');
        $randomId = Candidate::generateRandomId();

        // Create the candidate
        Candidate::create([
            'random_id' => $randomId,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'passport_number' => $request->passport_number,
            'cnic_number' => $request->cnic_number,
            'age' => $request->age,
            'city' => $request->city,
            'applied_country' => $request->applied_country,
            'applied_company' => $request->applied_company,
            'applied_position' => $request->applied_position,
            'cv_file_path' => $filePath, // Save the file path
            'test_status' => 'Fail', // Default value
            'payment_status' => 'Unpaid', // Default value
            'cv_status' => 'Not Submitted', // Default value
            'visa_status' => 'Pending', // Default value
        ]);
    
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

    public function addRemark(Request $request, Candidate $candidate)
    {
        // Validate the request
        $request->validate([
            'remarks' => 'required|string|max:255',
        ]);

        // Update the candidate's remarks
        $candidate->update([
            'remarks' => $request->remarks,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.candidates.index')
            ->with('success', 'Remark added successfully!');
    }


    /**
     * Update Visa Status (CV Loader's Action)
     */

    /**
     * Upload CV (CV Loader's Action)
     */
  


   
   public function updateCvStatus(Request $request, Candidate $candidate)
   {
       // Validate the request
       $request->validate([
           'cv_status' => 'required|in:Not Submitted,Submitted',
       ]);

       // Update the candidate's CV status
       $candidate->update([
           'cv_status' => $request->cv_status,
       ]);

       // Redirect back with success message
       return redirect()->route('admin.candidates.index')
           ->with('success', 'CV status updated successfully!');
   }

   /**
    * Update Visa Status (CV Loader's Action)
    */
   public function updateVisaStatus(Request $request, Candidate $candidate)
   {
       // Validate the request
       $request->validate([
           'visa_status' => 'required|in:Pending,Accepted,Rejected',
       ]);

       // Update the candidate's visa status
       $candidate->update([
           'visa_status' => $request->visa_status,
       ]);

       // Redirect back with success message
       return redirect()->route('admin.candidates.index')
           ->with('success', 'Visa status updated successfully!');
   }

   /**
    * Upload CV (CV Loader's Action)
    */
   public function uploadCv(Request $request, Candidate $candidate)
   {
       // Validate the request
       $request->validate([
           'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB, PDF/DOC/DOCX files
       ]);

       // Store the CV file
       $filePath = $request->file('cv_file')->store('cvs', 'public');

       // Update the candidate's CV file path
       $candidate->update([
           'cv_file_path' => $filePath,
       ]);

       // Redirect back with success message
       return redirect()->route('admin.candidates.index')
           ->with('success', 'CV uploaded successfully!');
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
  // Update test status (for Instructor)
  public function updateTestStatus(Request $request, Candidate $candidate)
  {
      // Validate the request
      $request->validate([
          'test_status' => 'required|in:Pass,Fail'
      ]);

      // Update the candidate's test status
      $candidate->update([
          'test_status' => $request->test_status
      ]);

      // Redirect back with success message
      return redirect()->route('admin.candidates.index')
          ->with('success', 'Test status updated successfully!');
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