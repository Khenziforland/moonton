<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Movie\Store;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Validations\Admin\Movie\MovieValidation;
use App\Services\Admin\Movie\MovieService;

class MovieController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Admin\Movie\MovieValidation
     */
    protected $movieValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Admin\Movie\MovieService
     */
    protected $movieService;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(MovieValidation $movieValidation, MovieService $movieService)
    {
        $this->movieValidation = $movieValidation;
        $this->movieService = $movieService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->movieService->index();

        return inertia('Admin/Movie/Index', [
            'movies' => $result->movies,
        ]);
    }

    /**
     * Create.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Movie/Create');
        
    }

    /**
     * Store.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->movieValidation->store($request);

        if ($validation->status == false) {
            return redirect(route('admin.dashboard.movie.create'))->with([
                'message' => "Data Gagal Divalidasi",
                'type' => "danger"
            ]);
        }

        $result = $this->movieService->store($request);

        if ($result->status == false) {
            return redirect(route('admin.dashboard.movie.create'))->with([
                'message' => "Movie Insert Failed",
                'type' => "danger"
            ]);
        }

        return redirect(route('admin.dashboard.movie.index'))->with([
            'message' => "Movie inserted successfully",
            'type' => "success"
        ]);
    }

    /**
     * Show.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Edit.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        // $result = $this->movieService->edit($request);

        return inertia('Admin/Movie/Edit', [
            'movie' => $movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $this->movieValidation->update($request, $id);

        if ($validation->status == false) {
            return redirect(route('admin.dashboard.movie.edit'))->with([
                'message' => "Data Gagal Divalidasi",
                'type' => "danger"
            ]);
        }

        $result = $this->movieService->update($request);

        if ($result->status == false) {
            return redirect(route('admin.dashboard.movie.edit'))->with([
                'message' => "Movie Update Failed",
                'type' => "danger"
            ]);
        }

        return redirect(route('admin.dashboard.movie.index'))->with([
            'message' => "Movie Update successfully",
            'type' => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $result = $this->movieService->destroy($movie);
        return redirect(route('admin.dashboard.movie.index'))->with([
            'message' => $result->message,
            'type' => 'success',
        ]);
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $result = $this->movieService->restore($id);
        return redirect(route('admin.dashboard.movie.index'))->with([
            'message' => $result->message,
            'type' => 'success',
        ]);
    }
}
