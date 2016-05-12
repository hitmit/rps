<?php

namespace School\Events\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Events\Models\EventsModel;
use School\Events\Http\Requests\CreateEventRequest;
use Redirect;

class EventsController extends Controller
{

    private $events;
    /**
     * Contrructor funtion
     */
    public function __construct(EventsModel $events) {
        $this->events = $events;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $events = $this->events->paginate($pagination);
        return view('events::events.list', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events::events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $this->events->create($request->only('eventTitle', 'eventDescription', 'eventFor', 'enentPlace', 'eventDate'));
        return Redirect::route('events.index')->withMessage('Event Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->events->where('id', $id)->first();
        if ($event)
        {
            return Redirect::route('events.edit', $event->id);
        }
        else
        {
            return Redirect::route('events.index')->withMessage('No event Found!!');
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
        $event = $this->events->where('id', $id)->first();
        if ($event)
        {
            return view('events::events.edit', compact('event'));
        }
        else
        {
            return Redirect::route('events.index')->withMessage('No event Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEventRequest $request, $id)
    {
        $data = $request->only('eventTitle', 'eventDescription', 'eventFor', 'enentPlace', 'eventDate');
        $this->events->where('id', $id)->update($data);
        return Redirect::route('events.index')->withMessage('Event Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $event = $this->events->where('id', $id)->first();
        if ($event) {
            return view('events::events.confirm', compact('event'));
        } else {
            return Redirect::route('events.index')->withMessage('No event Found!!');
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
        $this->events->where('id', $id)->delete();
        return Redirect::route('events.index')->withMessage('Event Deleted successfully');
    }
}
