<?php

namespace App\Http\Controllers\backend;

use App\Models\Question;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function create($id)
    {
        $question = Categories::findOrFail($id);
        $listQuestion = Question::where('category_id', $id)->get();
        return view('backend.v_question.create', [
            'judul' => 'Question',
            'sub' => 'Create Question',
            'question' => $question,
            'listQuestion' => $listQuestion,
        ]);
    }
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'content' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'required',
                'correct_option' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'content.required' => 'Pertanyaan harus diisi.',
                'correct_option.required' => 'Pilih salah satu jawaban yang benar.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
                'option_a' => 'Pilihan Harus diisi.',
                'option_b' => 'Pilihan Harus diisi.',
                'option_c' => 'Pilihan Harus diisi.',
                'option_d' => 'Pilihan Harus diisi.',
                'option_e' => 'Pilihan Harus diisi.',
            ],
        );

        $validatedData['status'] = 1;
        $validatedData['category_id'] = $id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $Extension = $image->getClientOriginalExtension();
            $imagePath = Str::random(10) . '_' . time() . '.' . $Extension;
            $image->move('storage/question', $imagePath);
            $validatedData['image'] = $imagePath;
        }

        Question::create($validatedData);

        return redirect()
            ->back()
            ->with('success', 'Soal berhasil dibuat');
    }

    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('backend.v_question.edit', [
            'judul' => 'Question',
            'sub' => 'Ubah Question',
            'question' => $question,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'content' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'required',
                'correct_option' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'content.required' => 'Pertanyaan harus diisi.',
                'correct_option.required' => 'Pilih salah satu jawaban yang benar.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
                'option_a.required' => 'Pilihan Harus diisi.',
                'option_b.required' => 'Pilihan Harus diisi.',
                'option_c.required' => 'Pilihan Harus diisi.',
                'option_d.required' => 'Pilihan Harus diisi.',
                'option_e.required' => 'Pilihan Harus diisi.',
            ],
        );

        $question = Question::findOrFail($id);

        $question->update([
            'content' => $validatedData['content'],
            'option_a' => $validatedData['option_a'],
            'option_b' => $validatedData['option_b'],
            'option_c' => $validatedData['option_c'],
            'option_d' => $validatedData['option_d'],
            'option_e' => $validatedData['option_e'],
            'correct_option' => $validatedData['correct_option'],
            'status' => 1,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imagePath = Str::random(10) . '_' . time() . '.' . $extension;
            $image->move('storage/question', $imagePath);

            if ($question->image) {
                Storage::delete('public/question/' . $question->image);
            }

            $question->update(['image' => $imagePath]);
        }

        return redirect('/question/create/' . $question->category_id)->with('success', 'Soal berhasil diubah');
    }

    public function publish(Request $request, string $id)
    {
        $question = Question::findOrFail($id);
        $validatedData['status'] = 1;
        $question->update($validatedData);

        return redirect()->back()->with('success', 'Pertanyaan berhasil dipublish');
    }
    public function draft(Request $request, string $id)
    {
        $question = Question::findOrFail($id);
        $validatedData['status'] = 2;
        $question->update($validatedData);

        return redirect()->back()->with('success', 'Pertanyaan berhasil disematkan');
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        Storage::delete('public/question/' . $question->image);
        $question->delete();
        return redirect()->back();
    }
}
