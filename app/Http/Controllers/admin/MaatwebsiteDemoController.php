<?php

namespace App\Http\Controllers\admin;


use App\clas;
use App\Helpers\EnConverter;
use App\Http\Controllers\Controller;
use App\ModelParent;
use App\student;
use App\teacher;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;


class MaatwebsiteDemoController extends Controller
{

    /*
     نمایش صفحه آپلود اکسل*
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExport()
    {
        return view('excle');
    }

    /*
     دانلود اکسل دانش آموزان از جدول یوزرز*
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel($type)
    {

        $data = User::
        where('role', 'دانش آموز')
            ->select('*')
            ->get()->toArray();

        return Excel::create('users', function ($excel) use ($data) {
            $excel->sheet('users', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /*
     آپلود اکسل دانش آموزان و ایجاد ردیف ها در جداول زیر:*
    * users-student-parent-clas
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {

        $request->validate([
            'import_file' => 'required'
        ]);
        $exist = [];
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        $unique = $data->unique('class');

        foreach ($unique as $uniqu) {
            $row = clas::where('classnamber', $uniqu->class)->first();

            if (empty($row) and $uniqu->class != null and  $uniqu->paye != null) {

                $clas = clas::create([
                    'classnamber' => $uniqu->class,
                    'paye' => $uniqu->paye,
                    'updated_at' => Jalalian::now(),
                    'created_at' => Jalalian::now(),

                ]);
            }


        }

        if ($data->count()) {
            foreach ($data as $key => $value) {
                if ($value->class != null and $value->paye != null and $value->codemeli != null and $value->l_name != null) {

                    $national_code = (string)EnConverter::bn2en($value->codemeli);
                    $national_code = str_replace(' ', '', $national_code);
                    $lenght = \Illuminate\Support\Str::length($national_code);
                    if ($lenght == 8) {
                        $national_code = '00' . $national_code;
                    } elseif ($lenght == 9) {
                        $national_code = '0' . $national_code;
                    }

                    $allstudent = User::where('codemeli', $national_code)->first();

                    if ($allstudent == null) {
                        $suser = User::create([
                            'codemeli' => $national_code,
                            'l_name' => $value->l_name,
                            'f_name' => $value->f_name,
                            'fname' => $value->fname,
                            'mobile' => $value->mobile,
                            'mobile_father' => $value->mobile_father,
                            'mobile_mother' => $value->mobile_mother,
                            'sex' => $value->sex,
                            'birthday' => $value->birthday,
                            'paye' => $value->paye,
                            'class' => $value->class,
                            'sabttime' => $value->sabttime,
                            'email' => $value->email,
                            'password' => Hash::make($value['codemeli']),
                            'role' => 'دانش آموز',
                            'level' => $value->level,
                            'status' => 1,
                            'updated_at' => Jalalian::now(),
                            'created_at' => Jalalian::now(),
                        ]);
                        $codmeli = '1' . $national_code;
                        $puser = User::create([
                            'id' => ($suser->id) + 1000,
                            'codemeli' => $codmeli,
                            'l_name' => $value->l_name,
                            'f_name' => $value->fname,
                            'paye' => $value->paye,
                            'class' => $value->class,
                            'password' => Hash::make($codmeli),
                            'mobile' => $value->mobile_father,
                            'role' => 'اولیا',
                            'status' => 1,
                            'updated_at' => Jalalian::now(),
                            'created_at' => Jalalian::now(),
                        ]);
                        $perent = student::create([
                            'user_id' => $suser->id,
                            'classid' => $value->class,
                            'updated_at' => Jalalian::now(),
                            'created_at' => Jalalian::now(),
                        ]);
                        $perent = ModelParent::create([
                            'user_id' => $puser->id,
                            'student_id' => $suser->id,
                            'updated_at' => Jalalian::now(),
                            'created_at' => Jalalian::now(),
                        ]);


                    } else {
                        $exist[] = $value->codemeli;
                    }
                }
            }
        }
        alert()->success('دانش آموزان و کلاس های شما به سامانه افزوده شد', 'بارگذاری اکسل')->autoclose(2000);

        return back()->withErrors($exist);
    }

}
