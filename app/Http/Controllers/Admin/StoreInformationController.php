<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoreInformationController extends Controller
{
    /**
     * Show Store / Customer Assistance Settings
     */
    public function index()
    {
        $store = StoreInformation::first();

        return view('admin.store-information.index', compact('store'));
    }


    /**
     * Add / Update Store Information
     */
    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'heading'            => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'product_query_text' => 'nullable|string|max:255',
            'availability_text'  => 'nullable|string|max:255',
            'whatsapp_text'      => 'nullable|string|max:255',
            'support_email'      => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'map_url'            => 'nullable|string',
        ]);


        // Get first record
        $store = StoreInformation::first();

        // If record doesn't exist, create new object
        if (!$store) {
            $store = new StoreInformation();
        }


        /*
        |--------------------------------------------------------------------------
        | Image Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if ($store->image) {

                $oldImage = public_path(
                    'uploads/store/' . $store->image
                );

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }


            // Upload new image
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/store'),
                $imageName
            );

            $store->image = $imageName;
        }


        /*
        |--------------------------------------------------------------------------
        | Customer Assistance Information
        |--------------------------------------------------------------------------
        */

        $store->heading = $request->heading;

        $store->description = $request->description;

        $store->product_query_text = $request->product_query_text;

        $store->availability_text = $request->availability_text;

        $store->whatsapp_text = $request->whatsapp_text;


        /*
        |--------------------------------------------------------------------------
        | Contact Information
        |--------------------------------------------------------------------------
        */

        $store->support_email = $request->support_email;

        $store->phone = $request->phone;


        /*
        |--------------------------------------------------------------------------
        | Google Map
        |--------------------------------------------------------------------------
        */

        $store->map_url = $request->map_url;


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $store->save();


        return redirect()
            ->route('admin.store-information.index')
            ->with('success', 'Customer assistance information updated successfully.');
    }


    /**
     * Delete Store Information
     */
    public function destroy()
    {
        $store = StoreInformation::first();

        if ($store) {

            // Delete uploaded image
            if ($store->image) {

                $imagePath = public_path(
                    'uploads/store/' . $store->image
                );

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Delete database record
            $store->delete();
        }


        return redirect()
            ->route('admin.store-information.index')
            ->with('success', 'Customer assistance information deleted successfully.');
    }
}