<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class NewsController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new \App\News;
        $this->middleware('sentry.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Sentry::getUser();
        $rows = $this->model
            ->select('*')
            ->where('user_id', $user->id)
            ->paginate(10);

        return view('users.news.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
        ]);
        $user = \Sentry::getUser();
        $filename = '';
        if ($request->hasFile('photo')) {
            $filename = basename($request->file('photo')->getClientOriginalName() . uniqid('-fl-'), '.' . $request->file('photo')->getClientOriginalExtension());
            $filename = $filename . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('uploads/news'), $filename);
        }
        $this->model->create([
            'title' => $request->title,
            'user_id' => $user->id,
            'photo' => $filename,
            'description' => $request->description,
            'reporter_name' => $request->reporter_name,
            'reporter_email' => $request->reporter_email,
        ]);

        return redirect('user/news')->with('success', 'News added scuccessfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = $this->model->find($id);        
        if(!$this->chkOwnId($row->user_id)){
            return redirect('user/news')->with('error', 'You can not access it.');
        }
        return view('users.news.edit', compact('row'));
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = $this->model->select('user_id')->find($id);        
        if(!$this->chkOwnId($row->user_id)){
            return redirect('user/news')->with('error', 'You can not access it.');
        }
        $this->model
            ->where('id', $id)
            ->delete();
        return redirect('user/news')->with('success', 'News deleted scuccessfully.');
    }
    
    private function chkOwnId($id)
    {
        $user = \Sentry::getUser();        
        if($user->id==$id){
            return true;            
        }else{
            return false;            
        }
    }
}
