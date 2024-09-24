<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function index()
    {
        $record = Post::get();
        // return response()->json([
        //     'status' => true,
        //     'message' => 'All Record Show !!',
        //     'data' => $record
        // ], 200);
        return $this->sendresponse($record, 'All Record Show !!');
    }

    public function store(Request $request)
    {
        // dd($request->image);
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required|unique:posts',
                'image' => 'required'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors(),
            ], 401);
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path() . '/uploads/', $imageName);

        $add = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Inserted !!',
            'data' => $add
        ], 200);
    }


    public function show(string $id)
    {
        $singleRecord = Post::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Single Record Show !!',
            'data' => $singleRecord
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error !!',
                'error' => $validateUser->errors()->all()
            ], 401);
        }

        $postImage = Post::select('id', 'image')->where(['id' => $id])->get();
        if ($request->image != '') {
            $path = public_path() . '/uploads/';

            if ($postImage[0]->image != '' && $postImage[0]->image != null) {
                $old_file = $path . $postImage[0]->image;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }

            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path() . '/uploads/', $imageName);
        } else {
            $imageName = $postImage[0]->image;
        }

        $update = Post::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Updated !!',
            'data' => $update
        ], 200);
        //  return $this->sendresponse($update, 'Data Updated !!');
    }


    public function destroy(string $id)
    {
        $imagePath = Post::select('image')->where('id', $id)->get();
        $filePath = public_path() . '/uploads/' . $imagePath[0]['image'];
        unlink($filePath);


        $user = Post::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Deleted !!',
            'data' => $user
        ], 200);
        //   return $this->sendresponse($user, 'Data Deleted !!');
    }

    public function addPage()
    {
        return view('add');
    }

    public function Dashborad()
    {
        return view('dashboard');
    }

    public function loginPage()
    {
        return view('login');
    }
}