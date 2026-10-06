<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view(
            'admin.contact-messages.index',
            compact('messages')
        );
    }


public function show(ContactMessage $contactMessage)
{
    if (!$contactMessage->is_read) {

        $contactMessage->is_read = true;

        $contactMessage->save();
    }

    return view(
        'admin.contact-messages.show',
        compact('contactMessage')
    );
}


    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}