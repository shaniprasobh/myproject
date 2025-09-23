<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:50',
        ]);

        Company::create($request->only([
            'company_name',
            'address',
            'email',
            'mobile_number',
            'gst_number',
        ]));

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
            'gst_number' => 'nullable|string|max:50',
        ]);

        $company->update($request->only([
            'company_name',
            'address',
            'email',
            'mobile_number',
            'gst_number',
        ]));

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
