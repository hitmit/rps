<?php

namespace School\Newsboard\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Newsboard\Models\NewsBoardModel;
use School\Newsboard\Http\Requests\CreateNewsBoardRequest;
use Redirect;

class NewsBoardController extends Controller
{

    private $newsboard;
    /**
     * Contrructor funtion
     */
    public function __construct(NewsBoardModel $newsboard) {
        $this->newsboard = $newsboard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $news = $this->newsboard->paginate($pagination);
        return view('newsboard::newsboard.list', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsboard::newsboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsBoardRequest $request)
    {
        $data = $request->only('newsTitle', 'newsText', 'newsFor', 'newsDate');
        $data['creationDate'] = time();
        $this->newsboard->create($data);
        return Redirect::route('newsboard.index')->withMessage('News Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsboard = $this->newsboard->where('id', $id)->first();
        if ($newsboard) {
            return Redirect::route('newsboard.edit', $newsboard->id);
        } else {
            return Redirect::route('newsboard.index')->withMessage('No news Found!!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsboard = $this->newsboard->where('id', $id)->first();
        if ($newsboard)
        {
            return view('newsboard::newsboard.edit', compact('newsboard'));
        }
        else
        {
            return Redirect::route('newsboard.index')->withMessage('No news Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateNewsBoardRequest $request, $id)
    {
        $data = $request->only('newsTitle', 'newsText', 'newsFor', 'newsDate');
        $this->newsboard->where('id', $id)->update($data);
        return Redirect::route('newsboard.index')->withMessage('News Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $newsboard = $this->newsboard->where('id', $id)->first();
        if ($newsboard) {
            return view('newsboard::newsboard.confirm', compact('newsboard'));
        } else {
            return Redirect::route('newsboard.index')->withMessage('No news Found!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->newsboard->where('id', $id)->delete();
        return Redirect::route('newsboard.index')->withMessage('News Deleted successfully');
    }
}
