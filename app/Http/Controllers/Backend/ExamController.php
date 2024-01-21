<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Result;
use App\Models\Question;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam = Categories::where('status', 1)->get();
        $result = Result::all();
        $questionCount = Question::all();
        return view('backend.v_exam.index', [
            'judul' => 'Ujian',
            'sub' => 'Data Ujian',
            'exam' => $exam,
            'result' => $result,
            'questionCount' => $questionCount,
        ]);
    }
    public function result()
    {
        $kategori = Categories::orderBy('id', 'desc')->get();
        return view('backend.v_result.index', [
            'judul' => 'Result Exam',
            'sub' => 'Data Result Exam',
            'kategori' => $kategori,
        ]);
    }

    public function detailResult($id)
    {
        $category = Categories::findOrFail($id);
        $results = Result::where('category_id', $id)->get();
        $siswa = Siswa::all();
        return view('backend.v_result.detail', [
            'judul' => 'Detail Result Exam',
            'sub' => 'Detail Data Result Exam',
            'category' => $category,
            'result' => $results,
            'siswa' => $siswa,
        ]);
    }

    protected function isExamTime($exam)
    {
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        return $exam->tanggal_pelaksanaan >= $currentDate or $exam->tanggal_pelaksanaan <= $currentDate && $exam->jam_selesai <= $currentTime;
    }
    public function exam($token)
    {
        $exam = Categories::where('token', $token)->first();

        if ($exam == null) {
            return redirect()
                ->back()
                ->with('errorToken', 'Siswa tidak boleh meninggalkan ujian');
        } elseif ($exam->status == 2) {
            return redirect()
                ->back()
                ->with('errorStatus', 'Tidak diperbolehkan memulai ujian lewat URL !!');
        } else {
            $user = auth()->user();
            $result = Result::where('users_id', $user->id)
                ->where('category_id', $exam->id)
                ->exists();

            if ($result) {
                return redirect('/ujian')->with('errorStatus', 'Anda Sudah Melakukan Ujian Ini.');
            }

            $question = Question::where('category_id', $exam->id)->get();

            return view('exam.index', [
                'judul' => 'Ujian',
                'sub' => 'Data Ujian',
                'exam' => $exam,
                'question' => $question,
            ]);
        }
    }

    /**
     * elseif ($this->isExamTime($exam)) {
            return redirect('/ujian')->with('ExplayedDate', ' ');
        }
     * Show the form for creating a new resource.
     */

    public function save(Request $request)
    {
        $questionIds = $request->input('question_ids');
        $answers = $request->except('_token', 'question_ids');
        
        $trueCount = 0;
        $falseCount = 0;
        $results = [];
        
        foreach ($questionIds as $questionId) {
            $answerKey = 'id-' . $questionId;
            $isCorrect = $answers[$answerKey] === Question::find($questionId)->correct_option;
            
            $results[] = [
                'user_id' => auth()->user()->id,
                'question_id' => $questionId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            if ($isCorrect) {
                $trueCount++;
            } else {
                $falseCount++;
            }
        }
        
        $resultData = [
            'users_id' => auth()->user()->id,
            'category_id' => $request->categories,
            'true' => $trueCount,
            'false' => $falseCount,
            'nilai' => null, 
            'cheat' => $request->cheat ? $request->cheat : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        Result::create($resultData);

        return redirect('/ujian')->with('success', 'Anda Telah Melakukan Ujian!!');
    }
}
