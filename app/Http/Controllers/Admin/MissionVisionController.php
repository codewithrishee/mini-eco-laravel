<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MissionVision;
use Illuminate\Http\Request;

class MissionVisionController extends Controller
{
    public function index()
    {
        $missionVision = MissionVision::first();

        return view('admin.mission-vision.index', compact('missionVision'));
    }

    public function edit()
    {
        $missionVision = MissionVision::first();

        if (!$missionVision) {
            $missionVision = new MissionVision();
        }

        return view('admin.mission-vision.form', compact('missionVision'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
        ]);

        $missionVision = MissionVision::first();

        if (!$missionVision) {
            $missionVision = new MissionVision();
        }

        $missionVision->mission_title = $request->mission_title;
        $missionVision->mission_description = $request->mission_description;
        $missionVision->vision_title = $request->vision_title;
        $missionVision->vision_description = $request->vision_description;
        $missionVision->save();

        return redirect()
            ->route('admin.mission-vision.index')
            ->with('success', 'Mission & Vision updated successfully.');
    }
}