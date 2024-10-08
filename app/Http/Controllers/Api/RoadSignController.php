<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoadSign;
use App\Models\SubRoadSign;
class RoadSignController extends Controller
{
    public function index()
    {
        // Fetch all main road signs with their sub-signs
        $roadSigns = RoadSign::with('subSigns')->get();

        // Append image paths to each road sign
        $roadSigns->transform(function ($roadSign) {
            $roadSign->symbol_image = asset($roadSign->symbol_image); // Assuming symbol_image stores relative path

            // Append image paths to sub road signs
            $roadSign->subSigns->transform(function ($subSign) {
                $subSign->symbol_image = asset($subSign->symbol_image); // Assuming symbol_image stores relative path
                return $subSign;
            });

            return $roadSign;
        });

        return response()->json(['roadSigns' => $roadSigns]);
    }

   
    public function SubsignsDescription(Request $request)
    {
        $id=$request->id;

        $roadSign = SubRoadSign::find($id);

        if (!$roadSign) {
            return response()->json(['message' => 'Road sign not found'], 404);
        }
        
        $roadSign->symbol_image = asset($roadSign->symbol_image);
     
        return response()->json(['roadSignDescription' => $roadSign]);
    }
}
