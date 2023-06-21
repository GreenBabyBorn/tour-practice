<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourPhoto;
use Illuminate\Http\Request;
use App\Http\Resources\TourPhotoResource;
use Illuminate\Support\Facades\Storage;

class TourPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tour $tour)
    {
        return TourPhotoResource::collection($tour->photos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tour $tour)
    {
        $filename = $request->file('photo')->store('/', 'public');
        $photo = TourPhoto::create([
            'tour_id' => $tour->id,
            'filename' => $filename,
            'path' => asset('storage') . '/' . $filename,
        ]);
        return new TourPhotoResource($photo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourPhoto  $tourPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour, TourPhoto $tourPhoto)
    {
        return new TourPhotoResource($tour->photos->where('id', $tourPhoto->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TourPhoto  $tourPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour, TourPhoto $tourPhoto)
    {
        // dd($request->file('photo'));
        // if (Storage::disk('public')->exists($tourPhoto->filename)) {
        Storage::disk('public')->delete($tourPhoto->filename);
        // }
        $filename = $request->file('photo')->store('/', 'public');
        $tourPhoto->update([
            'tour_id' => $tour->id,
            'filename' => $filename,
            'path' => asset('storage') . '/' . $filename,
        ]);
        return new TourPhotoResource($tourPhoto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourPhoto  $tourPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour, TourPhoto $tourPhoto)
    {
        $tour->photos->where('id', $tourPhoto->id)->first()->delete();
        return response()->noContent();
    }
}