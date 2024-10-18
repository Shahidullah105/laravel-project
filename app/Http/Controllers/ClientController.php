<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ClientController extends Controller
{

    public function show() {
        $all = Client::all();
        return view('admin.client.show', compact('all'));
    }

 
    public function index() {
        return view('admin.client.add');
    }


    public function create(Request $request) {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required',
            'mobile' => 'required',
            'pic' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $image_rename = '';
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $image_rename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_rename);
        }

        $insert = Client::insertGetId([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'pic' => $image_rename,  
        ]);

        if ($insert) {
            return back()->with('success', 'Data inserted successfully');
        } else {
            return back()->with('error', 'Query failed');
        }
    }


    public function edit($id) {
        $record = Client::findOrFail($id);
        return view('admin.client.edit', compact('record'));
    }


    public function update(Request $request) {
        $id = $request->id;

        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required',
            'mobile' => 'required',
            'pic' => 'nullable|mimes:jpeg,jpg,png,gif|max:2040',  // Make pic optional
        ]);
    

        $oldimg = Client::findOrFail($id);
        $deleteimg=public_path('uploads/'.$oldimg['pic']);
        $image_rename = '';

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $ext = $image->getClientOriginalExtension();

            if(file_exists($deleteimg)){
                unlink($deleteimg);
              }

            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('uploads'), $image_rename);
            }
            else{
                $image_rename=$oldimg['pic'];
            }


        $update = Client::where('id', $id)->update([
            'name' => $request ->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'pic' => $image_rename,  
        ]);


        if ($update) {
            return back()->with('success', 'Data updated successfully');
        } else {
            return back()->with('error', 'Query failed');
        }
    }

    public function destroy($id) {
        $id = intval($id);
        $client = Client::find($id);

        if ($client) {
            $imagePath = public_path('uploads/' . $client->pic);  

           
            if (!empty($client->pic) && file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);  
            }

            $client->delete();
            return back()->with('success', 'Data deleted successfully');
        } else {
            return back()->with('error', 'Record not found');
        }
    }
}