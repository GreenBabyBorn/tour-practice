<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\TourPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TourResource::collection(Tour::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $filename = $request->file('photo')->store('/', 'public');
        $tour = Tour::create(
            [
                'name' => $request->name,
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'cost' => $request->cost,
            ]
        );
        // dd($tour->id);
        // $photo = TourPhoto::create([
        //     'tour_id' => $tour->id,
        //     'path' => asset('storage') . '/' . $filename,
        // ]);
        return new TourResource($tour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        return new TourResource($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        // if (Storage::disk('public')->exists($request->file('photo')->store('/', 'public'))) {
        //     Storage::delete($request->file('photo')->store('/', 'public'));
        // }
        // $filename = $request->file('photo')->store('/', 'public');
        $tour->update([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'date' => $request->date,
            'cost' => $request->cost,
        ]);
        // $photo = TourPhoto::update([
        //     'tour_id' => $tour->id,
        //     'path' => asset('storage') . '/' . $filename,
        // ]);
        return new TourResource($tour);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return response()->noContent();
    }
}