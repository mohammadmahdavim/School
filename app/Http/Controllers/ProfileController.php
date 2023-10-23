<?php

namespace App\Http\Controllers;

use App\teacher;
use App\TeacherPrograme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;
use Intervention\Image\Facades\Image;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user= User::where('id', auth()->user()->id)->first();
        $programs = TeacherPrograme::where('teacher_id', auth()->user()->id)->get();

        return view('profile.index', compact('user', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate(request(),
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'codemeli' => 'required',
            ]
        );

        $cover = $request->file('file');
        if (!empty($cover)) {
            $data = request()->except(['_token', '_method', 'file']);
            User::where('id', $id)->update($data);

            // update picture
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
            $user = User::find($id);
            $user->mime = $cover->getClientMimeType();
            $user->original_filename = $cover->getClientOriginalName();
            $user->filename = $cover->getFilename() . '.' . $extension;
//for resize
            $originalImage = $request->file('file');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/uploads/';
//            $originalPath = public_path() . '/images/';
//            $thumbnailImage->save($originalPath . time() . $originalImage->getClientOriginalName());
            $thumbnailImage->resize(150, 150);
            $thumbnailImage->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
            $user->resizeimage = time() . $originalImage->getClientOriginalName();
            $user->save();
            alert()->success('موفق', 'ویرایش شما با موفقیت ثبت گردید!');
            return back();
        } else {
            $data = request()->except(['_token', '_method']);
            User::where('id', $id)->update($data);
            alert()->success('موفق', 'ویرایش شما با موفقیت ثبت گردید!');
            return back();
        }
    }


    public function updatepassword(Request $request, $id)
    {

        $this->validate(request(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required',
            ]
        );

        $user = User::find($id);

        if ($request->old_password || $request->new_password || $request->confirm_password) {
            if (!Hash::check($request['old_password'], $user->password)) {
                alert()->error('پسورد وارد شده قبلی شما نادرست است', 'خطا')->autoClose(5000);
                return back();
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $password = Hash::make($request->new_password);
                    $user->update([
                        'password' => $password,
                        'password_show' => $request->new_password,
                    ]);
                    alert()->success('ویرایش شما با موفقیت ثبت گردید!', 'موفق');
                    return back();
                } else {
                    alert()->error('رمز عبور با تکرار آن مطابقت ندارد', 'خطا')->autoClose(5000);
                    return back();
                }
            }

        }

    }

    public function times(Request $request, $id)
    {
        if (auth()->user()->role == 'معلم') {
            $days = $request->day;
            if ($days != null) {
                $teacher = TeacherPrograme::where('teacher_id', $id)->get();
                foreach ($teacher as $teache) {
                    $teache->delete();
                }
                $new_day = $request->day;

                foreach ($new_day as $day) {
                    TeacherPrograme::create([
                        'teacher_id' => teacher::where('user_id', $id)->first()['user_id'],
                        'day' => $day,
                        'updated_at' => Jalalian::now(),
                        'created_at' => Jalalian::now(),
                    ]);
                }
            }
            $techer = teacher::where('user_id', $id)->first();
            $techer->update([
                'time1' => request('time1'),
                'time2' => request('time2'),
                'updated_at' => Jalalian::now(),
            ]);
            alert()->success('ویرایش شما با موفقیت ثبت گردید!', 'موفق');
            return back();
        } else {
            return view('errors.404');
        }
    }

}
