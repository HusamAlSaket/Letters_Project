<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;
    protected $relations = [];
    protected $view;
    protected $compact = [];
    protected $routeIndex;
    protected $routeShow;
    protected $routeUpdate;
    protected $routeDestroy;

    public function index()
    {
        $records = $this->model::where('deleted_at', 0)
            ->with($this->relations)
            ->get();

        if ($records->isEmpty()) {
            return view($this->view, array_merge($this->compact, ['message' => 'No records found']));
        }

        return view($this->view, array_merge($this->compact, ['activities' => $records]));
    }

    public function show($id)
    {
        $record = $this->model::where('id', $id)
            ->where('deleted_at', 0)
            ->with($this->relations)
            ->first();

        if (!$record) {
            return redirect()->route($this->routeIndex) 
                ->with('message', 'Record not found');
        }

        return view($this->view, array_merge($this->compact, ['record' => $record]));
    }

    public function update(Request $request, $id)
    {
        $record = $this->model::where('id', $id)
            ->where('deleted_at', 0)
            ->first();

        if (!$record) {
            return redirect()->route($this->routeIndex)
                ->with('message', 'Record not found');
        }

        $record->update($request->all());

        return redirect()->route($this->routeIndex)
            ->with('message', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $record = $this->model::where('id', $id)->first();

        if (!$record) {
            return redirect()->route($this->routeIndex)
                ->with('message', 'Record not found');
        }

        $record->update(['deleted_at' => 1]);

        return redirect()->route($this->routeIndex)
            ->with('message', 'Record deleted successfully');
    }
}
