<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Helpers\PermissionHelper;

class CompanyController extends Controller
/**
 * @var \App\Models\User|null
 */
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'view company')) {
            abort(403, 'You do not have permission to view companies.');
        }
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'create company')) {
            abort(403, 'You do not have permission to create companies.');
        }
        return view('companies.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'create company')) {
            abort(403, 'You do not have permission to create companies.');
        }

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
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'view company')) {
            abort(403, 'You do not have permission to view companies.');
        }
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'edit company')) {
            abort(403, 'You do not have permission to edit companies.');
        }
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'edit company')) {
            abort(403, 'You do not have permission to edit companies.');
        }

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
        /** @var \App\Models\User|null $user */
        $user = \auth()->user();
        if (!PermissionHelper::isUserPermittedTo($user, 'delete company')) {
            abort(403, 'You do not have permission to delete companies.');
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
