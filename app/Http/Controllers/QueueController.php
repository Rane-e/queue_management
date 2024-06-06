<?

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function joinQueue(Subject $subject)
    {
        $position = Queue::where('subject_id', $subject->id)->max('position') + 1;

        Queue::create([
            'user_id' => Auth::id(),
            'subject_id' => $subject->id,
            'position' => $position,
        ]);

        return redirect()->back()->with('status', 'You have joined the queue.');
    }

    public function skip($subjectId)
    {
       $currentUserQueue = Queue::where('subject_id', $subjectId)
       ->where('user_id', Auth::id())
       ->first();

   if ($currentUserQueue) {
       $currentPosition = $currentUserQueue->position;
       $nextUserQueue = Queue::where('subject_id', $subjectId)
           ->where('position', $currentPosition + 1)
           ->first();

       if ($nextUserQueue) {
           $currentUserQueue->update(['position' => $currentPosition + 1]);
           $nextUserQueue->update(['position' => $currentPosition]);
       }
   }

   return redirect()->back();
    }

    public function goToEnd($subjectId)
    {
        $currentUserQueue = Queue::where('subject_id', $subjectId)
            ->where('user_id', Auth::id())
            ->first();

        if ($currentUserQueue) {
            $maxPosition = Queue::max('position');

            Queue::where('position', '>', $currentUserQueue->position)
                ->decrement('position');
            $currentUserQueue->update([
                    'position' => $maxPosition
                ]);
            }

        return redirect()->back();
    }

    public function leaveQueue(Queue $queue)
    {
        if ($queue->user_id == Auth::id()) {
            $queue->delete();
            return redirect()->back()->with('status', 'You have left the queue.');
        }

        return redirect()->back()->with('status', 'You cannot leave this queue.');
    }
}