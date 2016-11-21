<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class FrontNewsController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new \App\News;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = $this->model
                ->select('*')
                ->orderBy('id', 'DESC')
                ->take(10)->get();
        return view('front.news.index', compact('rows'));
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
        return view('front.news.show', compact('row'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function feed()
    {
        // create new feed
        $feed = \App::make("feed");
        $rows = $this->model
                ->select('*')
                ->orderBy('id', 'DESC')
                ->take(10)->get();

        // set your feed's title, description, link, pubdate and language
        $feed->title = 'Crossover News';
        $feed->description = 'Crossover news feeds';        
        $feed->link = url('feed');
        $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
        $feed->pubdate = $rows[0]->created_at;
        $feed->lang = 'en';
        $feed->setShortening(true); // true or false
        $feed->setTextLimit(300); // maximum length of description text

        foreach ($rows as $row) {
            // set item's title, author, url, pubdate, description, content, enclosure (optional)*
            $feed->add($row->title, $row->reporter_name, \URL::to('news/show/'.$row->id), $row->created_at, $row->description);
        }
         return $feed->render('atom');
    }
}
