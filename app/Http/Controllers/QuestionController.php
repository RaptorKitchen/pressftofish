<?php
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function getQuestion()
    {
        $question = Question::inRandomOrder()->first();
        return response()->json($question);
    }

    public function submitAnswer(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
        ]);

        $questionAnswer = new QuestionAnswer([
            'user_id' => Auth::id(),
            'question_id' => $validated['question_id'],
            'answer' => $validated['answer'],
        ]);
        $questionAnswer->save();

        return response()->json(['message' => 'Answer submitted successfully']);
    }
}
