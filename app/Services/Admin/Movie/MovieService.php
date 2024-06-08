<?php

namespace App\Services\Admin\Movie;

use Illuminate\Support\Str;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    /**
     * Index service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function index()
    {
        $movies = Movie::withTrashed()->orderBy('deleted_at')->get();

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'movies' => $movies,
        ];

        return $result;
    }

    /**
     * Show service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function show($request)
    {
        $kelas = Kelas::firstWhere('id', $request->id);

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'kelas' => $kelas,
        ];

        return $result;
    }

    /**
     * Store service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category' => $request->category,
            'video_url' => $request->video_url,
            'rating' => $request->rating,
            'is_featured' => $request->is_featured,
        ];

        if ($request->is_featured == "false") {
            $data['is_featured'] = 0;
        }

        $data['thumbnail'] = Storage::disk('public')->put('movies', $request->file('thumbnail'));

        $movie = Movie::create($data);

        $status = true;
        $message = 'Data berhasil disimpan !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'movie' => $movie,
        ];

        return $result;
    }

    /**
     * Update service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $movie = Movie::firstWhere('id', $request->id);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category' => $request->category,
            'video_url' => $request->video_url,
            'rating' => $request->rating,
            'is_featured' => $request->is_featured,
        ];

        if ($request->is_featured == "false") {
            $data['is_featured'] = 0;
        }

        if ($request->file('thumbnail')) {
            $data['thumbnail'] = Storage::disk('public')->put('movies', $request->file('thumbnail'));
            Storage::disk('public')->delete($movie->thumbnail);
        } else {
            $data['thumbnail'] = $movie->thumbnail;
        }

        $movie = Movie::where('id', $request->id)
            ->update($data);

        $status = true;
        $message = 'Data berhasil diupdate !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Destroy service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function destroy($request)
    {
        $request->delete();

        $status = true;
        $message = 'Movie deleted successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Restore service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function restore($id)
    {
        Movie::withTrashed()->find($id)->restore();

        $status = true;
        $message = 'Movie restored successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
