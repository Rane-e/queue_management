<?
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Queue;

class AdminController extends Controller
{
    public function dashboard()
    {
        $subjects = Subject::all();
        return view('admin.dashboard', compact('subjects'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create(['name' => $request->name]);
        return redirect()->route('admin.dashboard')->with('success', 'Subject added successfully');
    }

    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect()->route('admin.dashboard')->with('success', 'Subject deleted successfully');
    }

    public function editQueue($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $queues = Queue::where('subject_id', $subjectId)->orderBy('position')->get();
        return view('admin.editQueue', compact('subject', 'queues'));
    }

    public function updateQueue(Request $request)
    {
        foreach ($request->queues as $queue) {
            if($queue['position']== 0) {
                Queue::where('id', $queue['id'])->delete();
            }
            else{
                Queue::where('id', $queue['id'])->update(['position' => $queue['position']]);
            }
        }
        return redirect()->route('admin.queue.edit', $request->subject_id)->with('success', 'Queue updated successfully');
    }
}
