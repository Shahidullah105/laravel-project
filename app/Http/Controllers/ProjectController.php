<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
     public function add(){
$all=Client::all();
        return view('admin.project.add',compact('all'));
     }

     public function show(){
     $all=Project::all();
     return view('admin.project.show',compact('all'));
     }


     public function store(Request $request){
  // dd($request->all());

   $request->validate([
    'project_name' => 'required|max:45',
    'client_id' => 'required',  
    'project_value' => 'required',
    'description' => 'required',
    'date' => 'required',
      
]);

$insert = Project::insertGetId([
'project_name' =>$request->project_name,
'client_id' =>$request->client_id,
'project_value' =>$request->project_value,
'description' =>$request->description,
'date' =>$request->date,
'creator'=> Auth::user()->id,
'slug'=>uniqid().rand(100000,10000000),
]);

if($insert){
    return back()->with('success', 'Data inserted Successfully');
} else {
    return back()->with('error', 'Query Failed');   
}



     }

public function edit ($id){
$all=Client::all();
$data=Project::where('id',$id)->firstOrFail();
return view('admin.project.edit',compact('data','all'));


}



public function update(Request $request){
    // dd($request->all());
  
     $request->validate([
      'project_name' => 'required|max:45',
      'client_id' => 'required',  
      'project_value' => 'required',
      'description' => 'required',
      'date' => 'required',
        
  ]);

  $id=$request->id;
  
  $update = Project::where('id',$id)->update([
  'project_name' =>$request->project_name,
  'client_id' =>$request->client_id,
  'project_value' =>$request->project_value,
  'description' =>$request->description,
  'date' =>$request->date,
  'editor'=> Auth::user()->id,
  
  ]);
  
  if($update){
      return back()->with('success', 'Data Updated Successfully');
  } else {
      return back()->with('error', 'Query Failed');   
  }
  
  
  
       }

     
}
