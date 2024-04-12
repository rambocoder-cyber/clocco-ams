<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ArtistController extends Controller
{
    public function deleteArtist($id)
    {
        $artist = DB::select("SELECT * FROM artists WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.deleteArtistModal', ['artist' => $artist[0] ?? null])->render()
        ]);
    }

    public function destroyArtist($id)
    {
        try {
            DB::delete("DELETE FROM artists WHERE id = ?", [$id]);
            DB::delete("DELETE FROM songs WHERE artist_id=?",[$id]);
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

    public function getAllArtist(){
        $page = request()->query('page', 1);
        $perPage = 2; // Number of items per page
        $offset = ($page - 1) * $perPage;

        $artists = DB::select("SELECT * FROM artists LIMIT ?, ?", [$offset, $perPage]);
        $totalCount = DB::selectOne("SELECT COUNT(*) AS total FROM artists")->total;
        $totalPages = ceil($totalCount / $perPage);

        return view('backend.artist.list', [
            'artists' => $artists,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }
    
    public function getArtist($id){
        $artist = DB::select("SELECT * FROM artists WHERE id = ?", [$id]);
        return response()->json([
            'page' => view('modals.editArtistModal', ['artist' => $artist[0] ?? null])->render()
        ]);
    }

    public function createArtist(){
        return response()->json([
            'page' => view('modals.createArtistModal')->render()
        ]);
    }

    public function updateArtist(Request $request){
        $data = $request->all();
        try {
            DB::transaction(function() use ($data) {
                DB::update("UPDATE artists SET name = ?, dob = ?,address = ?,gender = ?,first_release_year = ?,no_of_albums_released = ? WHERE id = ?", [
                    $data['name'],
                    $data['dob'],
                    $data['address'],
                    $data['gender'],
                    $data['first_release_year'],
                    $data['no_of_albums_released'],
                    (int)$data['id']
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
    

    public function storeArtist(Request $request){
        $data = $request->all();
        $has_songs = array_key_exists('addSongs',$data) ? 1 : 0;
        
        try {
            // Store the artist in DB
            DB::transaction(function() use($data,$has_songs){
                $artist = DB::insert("INSERT INTO artists (name, dob, address, gender, first_release_year, no_of_albums_released) VALUES (?, ?, ?, ?, ?, ?)", [
                    $data['name'],
                    $data['dob'],
                    $data['address'],
                    $data['gender'],
                    $data['first_release_year'],
                    $data['no_of_albums_released']
                ]);

                if ($artist) {
                    $artist_id = DB::selectOne("SELECT LAST_INSERT_ID() AS id")->id;
                } else {
                    throw new Exception('Creation failed , try again!');
                }
                
                

                if ($has_songs) {
                    $songsData = [];
                    for ($i = 0; $i < count($data['songs']['title']); $i++) {
                        $songsData[] = [
                            'artist_id' => $artist_id,
                            'title' => $data['songs']['title'][$i],
                            'album_name' => $data['songs']['album_name'][$i],
                            'genre' => $data['songs']['genre'][$i]
                        ];
                    }

                    $insertQuery = "INSERT INTO songs (artist_id, title, album_name, genre) VALUES ";
                    $insertValues = [];
                    foreach ($songsData as $songData) {
                        $insertValues[] = "({$songData['artist_id']}, '{$songData['title']}', '{$songData['album_name']}', '{$songData['genre']}')";
                    }
                    $insertQuery .= implode(", ", $insertValues);
                    DB::insert($insertQuery);
                }
                
            });

            Alert::toast('User Successfully registered', 'success');
            return redirect()->route('getAllArtist');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(),'error');
            return back();
        }


    }
}
