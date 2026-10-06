<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    /**
     * Show Contact Information
     */
    public function index()
    {
        $contact = ContactSetting::first();

        return view('admin.contact.index', compact('contact'));
    }


    /**
     * Add / Update Contact Information
     */
    public function update(Request $request)
    {
        $request->validate([
            'address'       => 'nullable|string|max:500',
            'phone'         => 'nullable|string|max:50',
            'email'         => 'nullable|email|max:255',
        ]);

        $contact = ContactSetting::first();

        if (!$contact) {
            $contact = new ContactSetting();
        }

        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;

        $contact->save();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Contact information saved successfully.');
    }


    /**
     * Delete Contact Information
     */
    public function destroy()
    {
        $contact = ContactSetting::first();

        if ($contact) {
            $contact->delete();
        }

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Contact information deleted successfully.');
    }
}