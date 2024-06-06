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
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Movie/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Movie/Create');
        
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
