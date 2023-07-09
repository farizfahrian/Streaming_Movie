<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    public function index()
    {
        try {
            $movieController = new MovieController();
            $request = Request::create('/api/movies', 'GET');
            $response = $movieController->index($request);
            $moviesData = $response->getOriginalContent();

            // Mendapatkan data movies dan paginationLinks dari response JSON
            $movies = $moviesData['movies'];
            // Mengirim data movies dan tautan paginasi ke tampilan
            return view('pages.admin.dashboard', compact('movies'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            // Mengirim pesan error ke tampilan
            return view('pages.admin.dashboard')->with(['error' => $errorMessage]);
        }
    }

    public function create()
    {
        return view('pages.admin.create');
    }

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

            // Redirect to admin dashboard
            return Redirect::route('admin.dashboard')->with('success', 'New Movie Created');
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function edit($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            return view('pages.admin.update', compact('movie'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Film tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = app('App\Http\Controllers\MovieController')->update($request, $id);
            $responseData = json_decode($response->getContent(), true);
            if (isset($responseData['success'])) {
                return redirect()->route('admin.dashboard')->with('success', 'Movie updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update movie.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update movie.');
        }
    }

    public function show($id)
    {
        try {
            $response = app('App\Http\Controllers\MovieController')->show($id);
            $responseData = json_decode($response->getContent(), true);
            if (isset($responseData['data'])) {
                $movie = $responseData['data'];
                
                $movies = Movie::paginate(11);
                return view('pages.movie-detail', compact('movie', 'movies'));
            } else {
                return redirect()->back()->with('error', 'Movie not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch movie details.');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $response = app('App\Http\Controllers\MovieController')->destroy($request, $id);
            $responseData = json_decode($response->getContent(), true);
            if (isset($responseData['success'])) {
                return redirect()->route('admin.dashboard')->with('message', 'Movie deleted successfully.');
            } else {
                return redirect()->route('admin.dashboard')->with('error', 'Failed to delete movie.');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to delete movie.');
        }
    }
}
