<?
namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function show(Subject $subject)
    {
        $queues = Queue::where('subject_id', $subject->id)->orderBy('position')->get();
        $userInQueue = Auth::check() ? Queue::where('subject_id', $subject->id)->where('user_id', Auth::id())->first() : null;
        $userName = Auth::check() ? Auth::user()->name : null;

        return view('subjects.show', compact('subject', 'queues', 'userInQueue', 'userName'));
    }
}
