<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return view('notice.index',compact('notices'));
    }

    public function create()
    {
        return view('notice.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'notice'=>'required',
            'priority'=>'required|numeric'

        ]);
        Notice::create($data);
        return redirect(route('notice.index'))->with('success','Notice create successfully');
    }

    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('notice.edit',compact('notice'));

    }

    public function update(Request $request,$id)
    {
        $data = $request -> validate([
            'notice' => 'required',
            'priority' => 'required|numeric'
        ]);
        $notice = Notice::find($id);
        $notice->update($data);
        return redirect(route('notice.index'));
    }

    public function destroy(Request $request)
    {
        $notice = Notice::find($request->id);
        $notice->delete();
        return redirect(route('notice.index'));
    }
}


