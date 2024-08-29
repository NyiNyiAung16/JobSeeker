<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Error;
use Exception;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function store(Request $request)
    {   
        $cleanData = $request->validate([
            'body' => 'required|string',
            'type' => 'required|string'
        ]);
        Content::create($cleanData);
        return redirect(route('admin.contentManagement'))->with('message',[
            'type' => 'success',
            'body' =>  $cleanData['type'].' contents created successfully.'
        ]);
    }

    public function edit(Content $content) {
        return inertia()->render('Admin/EditContent',compact('content'));
    }

    public function update(Content $content,Request $request)
    {
        try{
            $cleanData = $request->validate([
                'body' => 'required|string',
                'type' => 'required|string'
            ]);
            $content->update($cleanData);
            return redirect(route('admin.contentManagement'))->with('message',[
                'type' => 'success',
                'body' => $cleanData['type'].' contents updated successfully.'
            ]);
        }catch(Exception $e) {
            return back()->with('message',[
                'type' => 'error',
                'body' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Content $content) 
    {
        try{
            $content->delete();
            return back()->with('message',[
                'type' => 'success',
                'body' =>  $content->type.' contents deleted successfully.'
            ]);
        }catch(Exception $e) {
            return back()->with('message',[
                'type' => 'error',
                'body' => $e->getMessage()
            ]);
        }
    }
}
