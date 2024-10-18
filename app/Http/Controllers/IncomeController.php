<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use DB;
class IncomeController extends Controller
{

    public function add(){
        $all=Project::where('status',0)->orderBy('id', 'ASC')->get();

                return view('admin.income.add',compact('all'));
             }


             public function show(){
                $all=Income::where('status',1)->orderBy('id', 'ASC')->get();
        
                        return view('admin.income.show',compact('all'));
                     }
             public function store(Request $request){
             //dd($request->all());

             $request->validate([
              
                'project_id' => 'required',  
                'income_amount' => 'required',
                'date' => 'required',
                'note' => 'required',
                'bank_account' => 'required',
                  
            ]);


            $insert=Income::insertGetId([
               'project_id' => $request->project_id,
               'income_amount' => $request->income_amount,
               'date' => $request->date,
               'note' => $request->note,
               'bank_account_id' => $request->bank_account,
               'creator' => Auth::user()->id,
               
            ]);

            $data=Project::where('id',$request->project_id)->firstOrFail();

            $paid_amount = (float) $request->income_amount + (float) $data->paid_amount;
            $due_amount = (float) $data->project_value - (float)$paid_amount;

            if( $insert){
                $update = Project::where('id',$request->project_id)->update([
                    'paid_amount' => $paid_amount,
                    'due_amount' => $due_amount,
                    
                    ]);



                
             return redirect()->back()->with('success','Data inserted successfully');

            }






            

             }


             public function edit($id){
               $all=Project::where('status',0)->get();
               $data=Income::where('id',$id)->firstOrFail();
               return view('admin.income.edit',compact('data','all'));
             }



             public function update(Request $request){
               //dd($request->all());

               $request->validate([
              
                  'project_id' => 'required',  
                  'income_amount' => 'required',
                  'date' => 'required',
                  'note' => 'required',
                  'bank_account' => 'required',
                    
              ]);
              $oldincome=Income::where('id',$request->id)->firstOrFail();
  
              $update=Income::where('id', $request->id)->update([
                 'project_id' => $request->project_id,
                 'income_amount' => $request->income_amount,
                 'date' => $request->date,
                 'note' => $request->note,
                 'bank_account_id' => $request->bank_account,
                 'editor' => Auth::user()->id,
                 
              ]);

              $data=Project::where('id',$request->project_id)->firstOrFail();

              $paid_amount = (float) $request->income_amount + (float) $data->paid_amount - (float)$oldincome->income_amount;
              $due_amount = (float) $data->project_value - (float)$paid_amount;



              if( $update){
               $update = Project::where('id',$request->project_id)->update([
                   'paid_amount' => $paid_amount,
                   'due_amount' => $due_amount,
                   
                   ]);



               
            return redirect()->back()->with('success','Data updated successfully');

           }

  




             }
}
