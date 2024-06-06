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
    public function index($request)
    {
        $page = 1;
        $limit = 5;

        if ($request->page) {
            $page = $request->page;
        }

        if ($request->limit) {
            $limit = $request->limit;
        }

        $kelas = Kelas::getPaginatedData(true, $page, $limit, 'nama', 'asc');

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
        $data = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'max_kapasitas' => $request->max_kapasitas,
        ];

        $kelas = Kelas::where('id', $request->id)
            ->update($data);

        if ($request->pamflet) {
            Kelas::deletePamflet($request->id);
            Kelas::savePamflet($request->id, $request->pamflet);
        }

        $kelas = Kelas::firstWhere('id', $request->id);

        $status = true;
        $message = 'Data berhasil disimpan !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'kelas' => $kelas,
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
        Kelas::deletePamflet($request->id);
        Kelas::where('id', $request->id)
            ->delete();

        $status = true;
        $message = 'Data berhasil dihapus !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
