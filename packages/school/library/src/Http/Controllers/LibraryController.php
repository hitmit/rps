<?php

namespace School\Library\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Library\Models\LibraryModel;
use School\Library\Http\Requests\CreateLibraryRequest;
use Redirect;

class LibraryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $books = LibraryModel::paginate($pagination);
        return view('library::library.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('library::library.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLibraryRequest $request)
    {
        $data = $request->only('bookName', 'bookDescription', 'bookAuthor', 'bookType', 'bookPrice', 'bookState');
        if ($request->hasFile('bookFile'))
        {
            $destinationPath = 'uploads/library'; // upload path
            $fileInstance = $request->file('bookFile');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['bookFile'] = $newFileName;
        }
        LibraryModel::create($data);
        return Redirect::route('library.index')->withMessage('Book Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $library = LibraryModel::where('id', $id)->first();
        if ($library)
        {
            return Redirect::route('library.edit', $library->id);
        }
        else
        {
            return Redirect::route('library.index')->withMessage('No Book Found!!');
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
        $library = LibraryModel::where('id', $id)->first();
        if ($library)
        {
            return view('library::library.edit', compact('library'));
        }
        else
        {
            return Redirect::route('library.index')->withMessage('No Book Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateLibraryRequest $request, $id)
    {
        $data = $request->only('bookName', 'bookDescription', 'bookAuthor', 'bookType', 'bookPrice', 'bookState');
        if ($request->hasFile('bookFile'))
        {
            $destinationPath = 'uploads/library'; // upload path
            $fileInstance = $request->file('bookFile');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['bookFile'] = $newFileName;
        }
        LibraryModel::where('id', $id)->update($data);
        return Redirect::route('library.index')->withMessage('Book Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $library = LibraryModel::where('id', $id)->first();
        if ($library)
        {
            return view('library::library.confirm', compact('library'));
        }
        else
        {
            return Redirect::route('library.index')->withMessage('No Book Found!!');
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
        LibraryModel::where('id', $id)->delete();
        return Redirect::route('library.index')->withMessage('Book Deleted successfully');
    }
}
