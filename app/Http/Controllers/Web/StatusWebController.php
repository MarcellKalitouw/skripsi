<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;
use DB;

class StatusWebController extends Controller
{
    protected $pageTitle = 'Status';
    public function index()
    {
        $data = Status::withTrashed()->orderBy('sequence', 'asc')->get();
    
        return view('adminView.status.index', compact('data'));
    }

    public function create()
    {
        return view('adminView.status.create',['pageTitle'=>$this->pageTitle]);
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'sequence' => 'required'
        ]);

        $input = $request->except(['_token']);
        $status = Status::create($input);

        return redirect()->route('status.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $getData = Status::findOrFail($id);
        return view('adminView.status.edit', ['getData'=>$getData, 'pageTitle'=>$this->pageTitle]);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'sequence'=> 'required'
        ]);

        $input = $request->except(['_token','_method']);
        $status = Status::where('id', $id)->update($input);

        return redirect()->route('status.index');
    }
    public function destroy($id)
    {
        Status::where('id', $id)->delete();
        return redirect()->route('status.index');
    }
}