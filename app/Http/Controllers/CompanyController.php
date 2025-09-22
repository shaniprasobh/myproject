<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    // Display a listing of companies
    public function index()
    {
        $companies = Company::all(); // Pass all companies to the index view
        return view('companies.index', compact('companies'));
    }

    // Show the form for creating a new company
    public function create()
    {
        return view('companies.create');
    }

    // Store a newly created company in the database
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:50',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')
                         ->with('success', 'Company created successfully.');
    }

    // Display the specified company
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    // Show the form for editing the specified company
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Update the specified company in the database
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:50',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')
                         ->with('success', 'Company updated successfully.');
    }

    // Remove the specified company from the database
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
                         ->with('success', 'Company deleted successfully.');
    }
}
