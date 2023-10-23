<?php

namespace App\Http\Controllers;

use App\Barnameh;
use App\Exam;
use App\ExamAnswer;
use App\ExamQuestion;
use App\FileMoshaver;
use App\Film;
use App\JTamrin;
use App\LogFinanace;
use App\MailModel;
use App\MessageReseiver;
use App\OnlineClass;
use App\Question;
use App\Tamrin;
use App\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //controller for download


    public function tamrindownloadImage($imageId)
    {
        $book_cover = Tamrin::where('id', $imageId)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function jtamrinteacher($imageId)
    {

        $book_cover = Tamrin::where('id', $imageId)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->pfilename;
        return response()->download($path, $book_cover
            ->poriginal_filename, ['Content-Type' => $book_cover->pmime]);
    }

    public function film($imageId)
    {

        $book_cover = Film::where('id', $imageId)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, [
            'Content-Type' => $book_cover->mime]);

    }

    public function jtamrindownloadImage($imageId)
    {
        $book_cover = DB::table('jtamrin_files')->where('id', $imageId)->first();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function mail($id)
    {
        $mailid = MessageReseiver::where('id', $id)->first()['mail_id'];

        $book_cover = MailModel::where('id', $mailid)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function mailmodel($mailid)
    {
        $book_cover = MailModel::where('id', $mailid)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function barname($barnameid)
    {
        $book_cover = Barnameh::where('id', $barnameid)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function barnamedars($idclass)
    {
        $book_cover = Barnameh::where('classnumber', $idclass)->where('category', 'barnameh')->get();

        if (count($book_cover) == 0) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);

            return back();
        }
        $book_cover = Barnameh::where('classnumber', $idclass)->where('category', 'barnameh')->firstOrFail();
        if (empty($book_cover)) {
            return back()->withErrors('برنامه ای آپلود نشده است');
        }
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function barnameemtehan($idclass)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        if (DB::table('users')->where('id', $iduser)->pluck('status')->first() == 0) {
            alert()->warning('اجازه دانلود ندارید.', 'ناموفق')->autoclose(3000);

            return redirect('/student');
        }
        $book_cover = Barnameh::where('classnumber', $idclass)->where('category', 'emtehan')->get();

        if (count($book_cover) == 0) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);

            return back();
        }
        $book_cover = Barnameh::where('classnumber', $idclass)->where('category', 'emtehan')->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }


    public function questiondownloadImage($imageId)
    {
        $book_cover = Question::where('id', $imageId)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function barnamemoshaver($id)
    {

        $book_cover = FileMoshaver::where('id', $id)->get();

        if (count($book_cover) == 0) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);

            return back();
        }
        $book_cover = FileMoshaver::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function finance($id)
    {
        $book_cover = LogFinanace::where('id', $id)->get();

        if (count($book_cover) == 0) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);

            return back();
        }
        $book_cover = LogFinanace::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/finance/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function class($id)
    {
        $book_cover = OnlineClass::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function exam($id)
    {

        $book_cover = Exam::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/exam/' . $book_cover->filename;

        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function exam_question($id)
    {
        $book_cover = ExamQuestion::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/exam/' . $book_cover->file;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

    public function exam_answer($id)
    {
        $book_cover = ExamAnswer::where('id', $id)->firstOrFail();
        $path = public_path() . '/images/exam/' . $book_cover->filename;
        return response()->download($path, $book_cover
            ->original_filename, ['Content-Type' => $book_cover->mime]);
    }

}

