<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $movies = Movie::get();
            // Tidak ada lagi pembagian halaman

            return response()->json(['movies' => $movies], Response::HTTP_OK);
        } catch (QueryException $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validator = validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'rating' => 'required|numeric',
                'image_link' => 'required|url',
                'video_link' => 'required|url',
                'genre' => 'required|string',
                'release_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            Movie::create($request->all());
            $response = [
                'data' => $request->all(),
                'Success' => 'New Movie Created',
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $response = [
                'data' => $movie
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            $movie = Movie::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'duration' => 'required',
                'rating' => 'required',
                'image_link' =>  'required',
                'video_link' =>  'required',
                'genre' => 'required',
                'release_date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $movie->update($request->all());

            $response = [
                'data' => $movie,
                'success' => true,
                'message' => 'Movie Updated'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Movie not found'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            Movie::findOrFail($id)->delete();
            return response()->json(['success' => 'Movie deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
