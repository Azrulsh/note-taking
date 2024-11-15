<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RemarkRecord;


class RemarkController extends Controller
{
   public function index(){
    return view('manage-remark.IndexRemark');
   }

   public function getremark(){
      $remarks = RemarkRecord::all();
      return view('manage-remark.ListRemark', compact('remarks'));
   }

   public function saveremark(Request $request){
      if ($request->ajax()){
          // Create New Remark
          $remark = new RemarkRecord;
          $remark->description = $request->input('description');
          // Save Remark
          $remark->save();
          return response($remark);
      }
   }

   public function updateremark(Request $request){
      if ($request->ajax()){
          $remark = RemarkRecord::find($request->id);
          $remark->description = $request->input('description');
          $remark->save();
          return response($remark);
      }
   }  

   public function deleteremark(Request $request){
      if ($request->ajax()){
          RemarkRecord::destroy($request->id);
      }
  }
}