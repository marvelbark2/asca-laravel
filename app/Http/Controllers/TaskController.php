<?php

namespace App\Http\Controllers;

use App\Details;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth.lock');
    // }
    public function index()
    {
        $taches = Task::where('user_id', '0')
                    ->OrderBy('created_at', 'desc')
                    ->get();
        $high = Task::where('user_id', '0')
                    ->where('priority', '3')
                    ->OrderBy('created_at', 'desc')
                    ->get();
        $medium = Task::where('user_id', '0')
                    ->where('priority', '2')
                    ->OrderBy('created_at', 'desc')
                    ->get();
        $low = Task::where('user_id', '0')
                    ->where('priority', '1')
                    ->OrderBy('created_at', 'desc')
                    ->get();
        return view('task.gantt', compact('taches','high', 'medium', 'low'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('task.new', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->get('titre');
        $task->description = $request->get('description');
        $task->posted_user_id = Auth::user()->id;
        $task->user_id = $request->get('user');
        $task->priority = $request->get('priority');
        $task->status = "0";
        $task->deadline = $request->get('deadline');
        $task->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $tache)
    {

       // $tasks = Task::all();
        //echo $tache;
        return view('task.show', compact('tache'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $tache)
    {
        $users = User::all();
        //$tasks = Task::find($tache);
        //echo $tache;
        return view('task.edit',compact('tache', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $tache)
    {
        // $task = \App\Task::find($tache);
        // $task->user_id = Auth::user()->id;
        // $task->save();
        // Task::findOrFail($tache)->first()->fill($tache->user_id = Auth::user()->id)->save();
        $tache_id = $tache->id;
        $user_id = Auth::user()->id;
        \App\Task::where('id', $tache_id)
                ->update(['user_id' => $user_id]);
        return redirect('/mes-taches');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $tache)
    {
        $tache->delete();

        return redirect()->route('list-tache')->withStatus(__('La suppression de tache est effectuee.'));
    }
    public function mes()
    {
        $user_id = Auth::user()->id;
        $mt = Task::where('user_id', $user_id)->get();
        return view('task.mes', compact('mt'));
    }
    public function details(Task $tache)
    {
        $user_id = Auth::user()->id;
        $details = Details::where('task_id', $tache->id)->get();
        $taches = Task::where('id', $tache->id)
                    ->OrderBy('created_at', 'desc')
                    ->get();
        if (Auth::user()->type != 'super_admin')
        {
            if ($taches[0]->completed == '0') {
                //echo $taches[0];
                return view('task.details', compact('taches', 'details'));
            }
            elseif($taches[0]->user_id != Auth::user()->id){
                abort(404);
            }
            elseif($taches[0]->completed == '1'){
                return view('task.completed');
            }

            else{
                abort(404);
            }
        }
        else{
            return view('task.details', compact('taches', 'details'));
        }
    }
    public function completed(Request $request, Task $tache)
    {
        $tache_id = $tache->id;
        $taches = Task::where('user_id', '0')
                        ->OrderBy('created_at', 'desc')
                        ->get();
        //$user_id = Auth::user()->id;
        \App\Task::where('id', $tache_id)
                ->update(['completed' => '1', 'status' => '100']);
        return view('task.completed', compact('taches', 'tache'));
    }
    public function details_update(Request $request, Task $tache)
    {
        $details = new Details;
        $details->title = $request->get('titre');
        $details->details = $request->get('details');
        $details->task_id = $tache->id;
        $details->save();
        $tache_id = $tache->id;
        //$user_id = Auth::user()->id;
        \App\Task::where('id', $tache_id)
                ->update(['status' => $request->get('status')]);

    }
    public function list()
    {
        $tasks = Task::all();
        return view('task.list', compact('tasks'));
    }
    public function admin_details(Task $tache)
    {
        $details = Details::where('task_id', $tache->id)->get();
        //$tasks = Task::find($tache);
        return view('task.test', compact('tache', 'details'));
    }
    public function get(){
		$tasks = new Task();
		return response()->json([
			"data" => $tasks->all()
		]);
    }
    public function reactiver(Task $tache)
    {
        $tache_id = $tache->id;
        \App\Task::where('id', $tache_id)
                ->update(['completed' => '0', 'status' => '0']);
        return redirect('/mes-taches');
    }
    public function updatig(Request $request, Task $tache)
    {
        $radicado = \App\Task::findOrFail($tache)->first();
        $radicado->fill($request->only('titre', 'description', 'user', 'deadline'));//mass assign the new values
        $radicado->save();//save the instance

        return redirect('/admin/taches')->withPasswordStatus(__('La modification de tache est effectuee.'));;
    }
    public function deadline()
    {
        $tasks = Task::all();
        //$tasks = Task::find($tache);
        return view('task.deadline', compact('tasks'));
    }
    public function pdf(Task $tache)
    {
        //$taches = $tache;
       // $taches = Task::find($tache);
        $pdf = PDF::loadView('task.pdf', array('tache' => $tache), [], [
            'title' => $tache->title
          ]);
        return $pdf->save($tache->title.'.pdf');
    }
}
