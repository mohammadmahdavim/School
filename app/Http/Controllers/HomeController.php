<?php

namespace App\Http\Controllers;

use App\Blog;
use App\challenge;
use App\clas;
use App\Comment;
use App\Film;
use App\Home;
use App\MainPage;
use App\MainPagee;
use App\paye;
use App\PComment;
use App\PreRegistration;
use App\Question;
use App\RTamas;
use App\Tags;
use App\User;
use Baghayi\Skyroom\Exception\NotFound;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;



class HomeController extends Controller
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $url = "https://persiapixel.net/eZLWwJUH2gPbNMT/SendSms.ashx?username=Meshkat&password=eZLWwJUH2gPbNMT&from=3000890075&To=09332676163&text=tex
//        $client = new Client();
//        $client->request('GET', 'https://somewebsite.com');
//
//        dd($client->getStatusCode());


        $educations = Film::where('dars', 0)->orderbydesc('created_at')->paginate(5);
        $sliders = Home::where('place', 'اسلایدر')->orderbydesc('created_at')->paginate(5);
        $bartars = Home::where('place', 'برترها')->orderbydesc('created_at')->get();
        $blog = Blog::where('status', 1)->orderBydesc('created_at')->first();
        $imags = Home::where('place', 'گالری تصویر')->orderby('created_at')->paginate(8);
        $services = Home::where('place', 'خدمات')->orderbydesc('created_at')->get();
        $questions = Question::orderbydesc('created_at')->get();
        $payams = Home::where('place', 'پیام های مشاوره ای')->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);
//        $portfolios = Home::where('place', 'نمونه کارها')->orderbydesc('created_at')->paginate(9);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $studentcount = User::where('role', 'دانش آموز')->count();
        $classcount = clas::all()->count();
        $kadrcount = User::wherenotin('role', ['دانش آموز', 'اولیا'])->count();
        $anjomancount = Home::where('place', 'انجمن')->count();
        $videos = Home::where('place', 'ویدیو')->get();
//        return $rowss;
        return view('home.index', compact('sliders', 'educations', 'bartars', 'blog', 'services', 'payams', 'recents',
            'rows', 'rowsss', 'rowss', 'studentcount', 'classcount', 'kadrcount', 'anjomancount', 'questions', 'imags','videos'));
    }

    private function handleErrors(array $result)
    {
        $errorException = self::ERROR_CODES[$result['error_code']] ?? null;
        if (!is_null($errorException)) {
            throw new $errorException($result['error_message']);
        }

        /**
         * Not a proper way of handling errors :(
         */
        $errorException = null;
        foreach ($this->correspondingErrorExceptions as $error => $class) {
            if (false != strstr($result['error_message'], $error)) {
                $errorException = $class;
                break;
            }
        }

        if (is_null($errorException)) {
            throw new \Exception($result['error_message'], $result['error_code']);
        } else {
            throw new $errorException($result['error_message'], $result['error_code']);
        }
    }

    public
    function login()
    {
        if (\auth()->user()) {
            if (auth()->user()->role == 'دانش آموز' or auth()->user()->role == 'اولیا') {
                alert()->success('به سایت خوش آمدید', 'موفق');
                return redirect('/student');
            } elseif (auth()->user()->role == 'معلم') {
                alert()->success('به سایت خوش آمدید', 'موفق');
                return redirect('/teacher');
            } else {
                alert()->success('به سایت خوش آمدید', 'موفق');
                return redirect('/admin/home');

            }
        } else return redirect('/login');
    }

    public
    function blogs()
    {

        $data = Blog::where('status', 1)->orderbydesc('created_at')->paginate(2);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $tags = Tags::orderbydesc('created_at')->get();
        $tags = $tags->unique('tag');

        return view('home.blog.index', compact('data', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));
    }

    public
    function blogsstore(Request $request)
    {

        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'name' => 'required',
            'role' => 'required',
            'body' => 'required',
        ]);


        //        ایجاد تالار جیدی در جدول challenge
        $jDate = Jalalian::now();

        $id = Blog::create([
            'name' => request('name'),
            'title' => request('title'),
            'role' => request('role'),
            'body' => request('body'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;
        if ($request->pic) {
            $cover = $request->file('pic');
            $filename = time() . '.' . '.png';
            $path = public_path('/images/' . $filename);
            Image::make($cover->getRealPath())->resize(800, 550)->save($path);
            $extension = $cover->getClientOriginalExtension();
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();

            $row = Blog::where('id', $id)->first();
            $row->update([
                'mime' => $mime,
                'original_filename' => $original_filename,
                'filename' => $filename,
            ]);
        }
        if (Auth::check()) {
            if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {
                $row = Blog::where('id', $id)->first();
                $row->update([
                    'status' => 1,
                ]);
            }
        }
        alert()->success('مطلب شما بعد از تایید در سایت قرار می گیرد.', 'ممنون از شما(:')->autoclose(4000);
        return back();

    }

    public
    function blogscreate()
    {

        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);

        return view('home.blog.create', compact('recents', 'rowsss', 'rows', 'rowss'));
    }

    public
    function blogssingle($id)
    {

        $row = Blog::where('id', $id)->first();

        $commentcount = Comment::where('matlab_id', $id)->where('status', 1)->count() + PComment::where('matlab_id', $id)->where('status', 1)->count();
        $nocount = Comment::where('status', 0)->where('matlab_id', $id)->count() + PComment::where('status', 0)->where('matlab_id', $id)->count();
        $time = Jalalian::now()->subMinutes(5);
        $comments1 = Comment::where('status', 1)->where('matlab_id', $id)->get();
        $comments2 = Comment::where('status', 0)->where('matlab_id', $id)->where('created_at', '>=', $time)->get();
        $comments = $comments1->merge($comments2);
        if (auth()->check()) {
            if (auth()->user()->role == 'مدیر') {
                $comments = Comment::where('matlab_id', $id)->get();
            }
        }

        $row->update([
            'view' => $row->view + 1,
        ]);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);

        return view('home.blog.single', compact('recents', 'rowsss', 'rows', 'rowss', 'row', 'commentcount', 'nocount', 'comments'));
    }

    public
    function blogslike($id)
    {

        $row = Blog::where('id', $id)->first();
        $row->update([
            'like' => $row->like + 1,
        ]);

        return redirect()->route('single.blog', $id);
    }

    public
    function question()
    {

        $data = challenge::where('status', 1)->orderbydesc('created_at')->paginate(4);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $tags = Tags::orderbydesc('created_at')->get();
        $tags = $tags->unique('tag');

        return view('home.question.index', compact('data', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));
    }

    public
    function questionstore(Request $request)
    {

        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'name' => 'required',
            'role' => 'required',
            'body' => 'required',
        ]);


        //        ایجاد تالار جیدی در جدول challenge
        $jDate = Jalalian::now();

        $id = challenge::create([
            'name' => request('name'),
            'title' => request('title'),
            'role' => request('role'),
            'description' => request('body'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;
        if (auth()->user()) {
            if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {
                $row = challenge::where('id', $id)->first();
                $row->update([
                    'status' => 1,
                ]);
            }
        }
        alert()->success('بحث شما بعد از تایید در سایت قرار می گیرد.', 'ممنون از شما(:')->autoclose(4000);
        return back();

    }

    public
    function questioncreate()
    {

        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);

        return view('home.question.create', compact('recents', 'rowsss', 'rows', 'rowss'));
    }

    public
    function questionsingle($id)
    {

        $row = challenge::where('id', $id)->first();
        $commentcount = Comment::where('matlab_id', $id)->where('status', 1)->count() + PComment::where('matlab_id', $id)->where('status', 1)->count();
        $nocount = Comment::where('status', 0)->where('matlab_id', $id)->count() + PComment::where('status', 0)->where('matlab_id', $id)->count();
        $time = Jalalian::now()->subMinutes(5);
        $comments1 = Comment::where('status', 1)->where('matlab_id', $id)->get();
        $comments2 = Comment::where('status', 0)->where('matlab_id', $id)->where('created_at', '>=', $time)->get();
        $comments = $comments1->merge($comments2);
        if (auth()->check()) {
            if (auth()->user()->role == 'مدیر') {
                $comments = Comment::where('matlab_id', $id)->get();
            }
        }

        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $recents = Home::orderbydesc('created_at')->paginate(5);

        return view('home.question.single', compact('recents', 'rowsss', 'rows', 'rowss', 'row', 'commentcount', 'nocount', 'comments'));
    }

    public
    function view($place)
    {
        $sidebar = $place;
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $rowws = Home::where('place', $place)->paginate(2);
        $tags = Tags::orderbydesc('created_at')->get();
        $tags = $tags->unique('tag');
        if ($place == 'اخبار') {
            return view('home.news', compact('sidebar', 'rowws', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));
        }

        if ($place == 'پرسنل') {
            $imags = Home::where('place', $place)->paginate(8);
            return view('home.persenel', compact('sidebar', 'imags', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));
        }

        if ($place == 'گالری تصویر') {
            $slidimage = Home::where('place', $place)->orderbydesc('created_at')->first();
            $slidimage2 = Home::where('place', $place)->orderbydesc('created_at')->skip(1)->take(1)->first();
            $imags = Home::where('place', $place)->orderbydesc('created_at')->paginate(4);
            return view('home.image', compact('slidimage', 'slidimage2', 'sidebar', 'imags', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));

        }
        return view('home.view', compact('sidebar', 'rowws', 'recents', 'rowsss', 'rows', 'rowss', 'tags'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function single($id)
    {
        $row = Home::where('id', $id)->first();
        $commentcount = Comment::where('matlab_id', $id)->where('status', 1)->count() + PComment::where('matlab_id', $id)->where('status', 1)->count();
        $nocount = Comment::where('status', 0)->where('matlab_id', $id)->count() + PComment::where('status', 0)->where('matlab_id', $id)->count();
        $time = Jalalian::now()->subMinutes(5);
        $comments1 = Comment::where('status', 1)->where('matlab_id', $id)->get();
        $comments2 = Comment::where('status', 0)->where('matlab_id', $id)->where('created_at', '>=', $time)->get();
        $comments = $comments1->merge($comments2);
        if (auth()->check()) {
            if (auth()->user()->role == 'مدیر') {
                $comments = Comment::where('matlab_id', $id)->get();
            }
        }

        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $tags = Tags::orderbydesc('created_at')->get();
        $tags = $tags->unique('tag');
        if ($row->place == 'نمونه کارها') {
            return view('home.singleportfolio', compact('tags', 'recents', 'comments', 'rowss', 'rows', 'rowsss', 'row', 'count', 'nocount'));

        } else {
            return view('home.single', compact('tags', 'recents', 'comments', 'rowss', 'rows', 'rowsss', 'row', 'commentcount', 'nocount'));
        }
    }

    public
    function viewtag($id)
    {
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $data = Tags::where('id', $id)->pluck('tag');
        $data = Tags::where('tag', $data)->pluck('matlab_id');
        $rowws = Home::orderbydesc('created_at')->wherein('id', $data)->paginate(2);
        $tags = Tags::orderbydesc('created_at')->get();
        $tags = $tags->unique('tag');
        $sidebar = Tags::where('id', $id)->first()['tag'];

        return view('home.view', compact('data', 'tags', 'recents', 'rowsss', 'rows', 'rowss', 'sidebar', 'rowws'));

    }

    public
    function search(Request $request)
    {
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();

        $searches = Home::
        where('title', 'like', '%' . Input::get('search') . '%')
            ->orwhere('place', 'like', '%' . Input::get('search') . '%')
            ->orwhere('little_body', 'like', '%' . Input::get('search') . '%')
            ->orwhere('body', 'like', '%' . Input::get('search') . '%')
            ->paginate(6);
        return view('home.search', compact('recents', 'rowsss', 'rows', 'rowss', 'searches'));

    }

    public
    function phoneme()
    {
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        return view('home.phoneme', compact('recents', 'rowsss', 'rows', 'rowss'));

    }

    public
    function about_us()
    {
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $guides = Home::where('place', 'راهنما')->orderbydesc('created_at')->get();

        return view('home.us', compact('guides', 'recents', 'rowsss', 'rows', 'rowss'));

    }

    public
    function rtamas(Request $request)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'place' => 'required',
            'email' => 'required',
        ]);

        RTamas::create([
            'email' => request('email'),
            'place' => request('place'),
            'date' => request('date1'),
            'phone' => request('phone'),
            'created_at' => Jalalian::now()
        ]);
        alert()->success('درخواست تماس با موفقیت ثبت شد', 'موفق');
        return back();
    }

    public
    function pre_registration()
    {
        $paye = paye::all();
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();

        return view('home.pre_registration', compact('paye', 'recents', 'rowsss', 'rows', 'rowss'));
    }

    public
    function registration(Request $request)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'Fname' => 'required',
            'mobile' => 'required|numeric',
            'paye' => 'required',
        ]);

        PreRegistration::create([
            'f_name' => request('f_name'),
            'l_name' => request('l_name'),
            'Fname' => request('Fname'),
            'paye' => request('paye'),
            'codemeli' => request('mobile'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('پیش ثبت نام با موفقیت ثبت شد', 'موفق');
        return back();
    }

    public
    function manage()
    {
        $paye = paye::all();
        $recents = Home::orderbydesc('created_at')->paginate(5);
        $rows = MainPage::where('id', 1)->first();
        $rowsss = MainPagee::where('id', 1)->first();
        $rowss = MainPagee::whereNotin('id', [1])->orderbydesc('created_at')->get();
        $data = Home::where('place', 'سخن مدیر')->first();
        return view('home.manage', compact('data', 'rows', 'rowsss', 'rowss', 'recents', 'paye'));
    }

    public
    function myTestAddToLog()

    {

        \LogActivity::addToLog('My Testing Add To Log.');

        dd('log insert successfully.');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function logActivity()

    {

        $logs = \LogActivity::logActivityLists();

        return view('logActivity', compact('logs'));

    }
}
