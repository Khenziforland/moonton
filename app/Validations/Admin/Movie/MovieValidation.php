<?php

namespace App\Validations\Admin\Movie;

class MovieValidation
{
    /**
     * Show validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function show($request)
    {
        $validation = [
            'id' => ['required', 'numeric', 'exists:kelas,id'],
        ];

        $message = [
            'id.required' => 'ID kategori produk tidak boleh kosong !',
            'id.numeric' => 'ID kategori produk harus angka !',
            'id.exists' => 'ID kategori produk tidak ditemukan !',
        ];

        $request->validate($validation, $message);

        $status = true;
        $message = 'Data berhasil divalidasi !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Store validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        $validation = [
            'name' => ['required', 'unique:movies,name'],
            'category' => ['required'],
            'video_url' => ['required', 'url'],
            'thumbnail' => ['required', 'image'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'is_featured' => ['nullable', 'boolean'],
        ];

        $message = [
            'name.required' => 'Nama Movie tidak boleh kosong !',
            'unique.required' => 'Nama Movie sudah dipakai !',

            'category.required' => 'Category movie tidak boleh kosong !',

            'video_url.required' => 'Video URL Movie tidak boleh kosong !',
            'video_url.url' => 'Video URL Movie harus berupa url !',

            'thumbnail.required' => 'Thumbnail Movie tidak boleh kosong !',
            'thumbnail.image' => 'Thumbnail Movie harus berupa image !',

            'rating.required' => 'Rating Movie tidak boleh kosong !',
            'rating.numeric' => 'Rating Movie harus berupa angka !',
            'rating.min' => 'Rating Movie tidak boleh kurang dari 0 !',
            'rating.max' => 'Rating Movie tidak boleh melebihi 5 !',
        ];

        $request->validate($validation, $message);

        $status = true;
        $message = 'Data berhasil divalidasi !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Update validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $validation = [
            'id' => ['required', 'numeric', 'exists:kelas,id'],
            'nama' => ['required'],
            'harga' => ['required', 'numeric'],
            'max_kapasitas' => ['required', 'numeric'],
        ];

        $message = [
            'id.required' => 'ID kelas tidak boleh kosong !',
            'id.numeric' => 'ID kelas harus angka !',
            'id.exists' => 'ID kelas tidak ditemukan !',

            'nama.required' => 'Nama kelas tidak boleh kosong !',

            'harga.required' => 'Harga kelas tidak boleh kosong !',
            'harga.numeric' => 'Harga kelas harus berupa angka !',

            'max_kapasitas.required' => 'Kapasitas maksimal kelas tidak boleh kosong !',
            'max_kapasitas.numeric' => 'Kapasitas maksimal kelas harus berupa angka !',
        ];

        $request->validate($validation, $message);

        $status = true;
        $message = 'Data berhasil divalidasi !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Destroy validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function destroy($request)
    {
        $validation = [
            'id' => ['required', 'numeric', 'exists:kelas,id'],
        ];

        $message = [
            'id.required' => 'ID kelas tidak boleh kosong !',
            'id.numeric' => 'ID kelas harus angka !',
            'id.exists' => 'ID kelas tidak ditemukan !',
        ];

        $request->validate($validation, $message);

        $status = true;
        $message = 'Data berhasil divalidasi !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
