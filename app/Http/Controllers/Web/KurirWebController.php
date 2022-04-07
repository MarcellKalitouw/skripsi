<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Kurir;
use Illuminate\Http\Request;
use DB, File;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;

class KurirWebController extends Controller
{
    protected $pageTitle = 'Kurir';
    
    
    public function validateForm($req){
        $req->validate([
            'id_pengusaha'=> 'required',
            'nama_kurir'=>'required|unique:kurir,nama_kurir',
            'password' => 'required',
            'foto_kurir' => 'required',
        ]);
    }
    public function findId($id){
        $find = Kurir::find($id);
        return $find;
    }

    public function index()
    {
        $kurir = DB::table('kurir')
                ->leftJoin('pengusaha', 'kurir.id_pengusaha', 'pengusaha.id')
                ->whereNull('kurir.deleted_at')
                ->select(
                    'kurir.*',
                    'pengusaha.nama as nama_pengusaha'
                )
                ->orderBy('created_at','desc')
                ->get();
        return view('adminView.kurir.index', compact('kurir'));
    }

    public function create()
    {
        //
        $pageTitle = $this->pageTitle;
        $getPengusaha = DB::table('pengusaha')->get();
        
        return view('adminView.kurir.create', compact('getPengusaha', 'pageTitle'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateForm($request);


        $input = $request->except(['_token']);
        if($request->hasfile('foto_kurir')){
            $fileName = time().'_'.$request->foto_kurir->getClientOriginalName();
            $request->foto_kurir->move(public_path('gambar_kurir'), $fileName);
            $input['foto_kurir'] = $fileName;
        }
        $input['password'] = bcrypt($input['password']);

        // dd($input);
        $email = '1802arthur@gmail.com';

        $details =[
            'title' => 'Thank you for signing in',
            'body' => 'You did it'
        ];
        Mail::to($email)->send(new Gmail($details));
        // if (Mail::failures()) {
        //    return response()->Fail('Sorry! Please try again latter');
        // }else{
        //     return response()->success('Great! Successfully send in your mail');
        // }
        
        $kurir = Kurir::create($input);
        return redirect()->route('kurir.index')->with('success','Data kurir <strong> "'.$request->nama_kurir.'" </strong> has been saved!!');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $pageTitle = $this->pageTitle;

        $getPengusaha = DB::table('pengusaha')->get();
        return view('adminView.kurir.edit',[
            'pageTitle'=>$pageTitle,
            'getPengusaha'=>$getPengusaha,
            'getData' => $this->findId($id)
        ]);

    }

    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'id_pengusaha'=> 'required',
            'nama_kurir'=>'required',
        ]);
        $check = $this->findId($id);
        $input = $request->except(['_token', '_method']);

        if(is_file($request->foto_kurir)){
            $fileName = time().'.'.$request->foto_kurir->extension();  
            $request->foto_kurir->move(public_path('foto_kurir'), $fileName);
            $input['foto_kurir'] = $fileName;
            File::delete(public_path('gambar_kurir/'.$oldData->foto_kurir));
        }else{
            // dd('File does not exists.');
            $input['foto_kurir'] = $check->foto_kurir;
        }
        // dd($check); 
        if($check){
            if($input['password'] != null){
                $input['password'] = bcrypt($input['password']);
            }
            else{
                $input['password'] = $check->password;
            }
        }
        //  dd($input);
        
        $pengusaha = $this->findId($id)->update($input );
        return redirect()->route('kurir.index')->with('success','Data kurir <strong> "'.$request->nama_kurir.'" </strong> has been updated!!');

    }

    public function destroy($id)
    {
        //
        // $data = $this->findId($id)->delete();
        $data = DB::table('kurir')->where('id',$id)->delete();
        return redirect()->route('kurir.index')->with('deleted','Data kurir  has been deleted!!');
        
    }
}