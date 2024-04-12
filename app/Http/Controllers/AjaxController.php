<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getUser($id)
    {
        $specific_user = DB::select("SELECT * FROM users WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.editUserModal', ['specific_user' => $specific_user[0] ?? null])->render()
        ]);
    }

    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM users WHERE id = ?", [$id]);
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

    public function createUser()
    {
        return response()->json([
            'page' => view('modals.createUserModal')->render()
        ]);
    }

    public function deleteUser($id)
    {
        $user = DB::select("SELECT * FROM users WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.deleteUserModal', ['user' => $user[0] ?? null])->render()
        ]);
    }

    public function showUser($id)
    {
        $user = DB::select("SELECT * FROM users WHERE id = ? LIMIT 1", [$id]);
        return response()->json([
            'page' => view('modals.showUserModal', ['user' => $user[0] ?? null])->render()
        ]);
    }

    public function storeUser(Request $request)
    {
        $data = $request->all();
        try {
            DB::insert("INSERT INTO users (first_name, last_name, email, password, dob, phone, gender, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                bcrypt($data['password']),
                $data['dob'],
                $data['phone'],
                $data['gender'],
                $data['address']
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

    public function updateUser(Request $request)
    {
        $data = $request->all();
        try {
            DB::transaction(function () use ($data) {
                DB::update("UPDATE users SET first_name = ?, last_name = ?, email = ?, dob = ?, phone = ?, gender = ?, address = ? WHERE id = ?", [
                    $data['first_name'],
                    $data['last_name'],
                    $data['email'],
                    $data['dob'],
                    $data['phone'],
                    $data['gender'],
                    $data['address'],
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
}
