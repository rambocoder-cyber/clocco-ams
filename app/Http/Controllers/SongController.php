<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    public function getSongs($id){
        $page = request()->query('page', 1);
        $perPage = 5; // Number of items per page
        $offset = ($page - 1) * $perPage;

        $songs = DB::select("
            SELECT songs.*, artists.name AS artist_name, artists.dob AS artist_dob, artists.address AS artist_address, artists.gender AS artist_gender, artists.first_release_year AS artist_first_release_year, artists.no_of_albums_released AS artist_no_of_albums_released
            FROM songs
            INNER JOIN artists ON songs.artist_id = artists.id
            WHERE songs.artist_id = ?
            LIMIT ?, ?
        ", [$id, $offset, $perPage]);
        
        $totalCount = DB::selectOne("
            SELECT COUNT(*) AS total
            FROM songs
            WHERE artist_id = ?
        ", [$id])->total;

        $totalPages = ceil($totalCount / $perPage);

        return view('backend.songs.index', [
            'songs' => $songs,
            'id' => $id,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function createSong($id){
        return response()->json([
            'page' => view('modals.createSongModal',['artist_id' => $id])->render()
        ]);
    }

    public function storeSong(Request $request){
        $data = $request->all();
        try {
            DB::insert("INSERT INTO songs (title, album_name, genre,artist_id) VALUES (?, ?, ?, ?)", [
                $data['title'],
                $data['album_name'],
                $data['genre'],
                $data['artist_id']
            ]);
            return response()->json([
                'message' => 'Created Successfully',
                'response' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'response' => false
            ]);
        }
    }

    public function editSong($id){
        $song = DB::select("SELECT * FROM songs WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.editSongModal', ['song' => $song[0]])->render()
        ]);
    }

    public function updateSong(Request $request){
        $data = $request->all();
        try {
            DB::transaction(function () use ($data) {
                DB::update("UPDATE songs SET title = ?, album_name = ?, genre = ? WHERE id = ?", [
                    $data['title'],
                    $data['album_name'],
                    $data['genre'],
                    (int) $data['id']
                ]);
            });
            return response()->json([
                'message' => 'Updated Successfully',
                'response' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'response' => false
            ]);
        }
    }

    public function deleteSong($id){
        $song = DB::select("SELECT * FROM songs WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.deleteSongModal', ['song' => $song[0] ?? null])->render()
        ]);
    }

    public function destroySong($id){
        try {
            DB::delete("DELETE FROM songs WHERE id = ?", [$id]);
            return response()->json([
                'message' => 'Deleted Successfully',
                'response' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'response' => false
            ]);
        }
    }
}
