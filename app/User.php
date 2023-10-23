<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Morilog\Jalali\Jalalian;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function students()
    {
        return $this->hasOne(student::class)->withDefault();
    }

    public function teachers()
    {
        return $this->hasOne(teacher::class, 'user_id');
    }

    public function marks()
    {
        return $this->hasMany(mark::class, 'user_id');
    }

    public function tamrins()
    {
        $this->hasMany(Tamrin::class, 'user_id');
    }

    public function jtamrin()
    {
        $this->hasMany(JTamrin::class, 'user_id');
    }

    public function markitems()
    {

        return $this->hasMany(MarkItem::class, 'user_id');
    }

    public function markitem()
    {

        return $this->hasMany(MarkItem::class, 'id', 'user_id');
    }

    public function TotalMarks()
    {
        return $this->hasMany(TotalMark::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !!$role->intersect($this->roles)->count();
    }

    public function activationCode()
    {
        return $this->belongsTo(ActivationCode::class)->withDefault();
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

     public function rollcall()
    {
        return $this->hasMany(RollCall::class)->where('created_at','>=', Carbon::now()->toDateString())->where('author', auth()->user()->id);
    }

    public function rollcalltime()
    {
        return $this->hasMany(RollCall::class)
            ->where('created_at','>=', Carbon::now()->subMinutes(90)->toDateTimeString())
            ->where('author', auth()->user()->id);
    }

    public function student_class()
    {
        return $this->belongsTo(clas::class, 'class', 'classnamber')->withDefault();
    }

    public function paytuition()
    {
        return $this->belongsTo(PayTuition::class)->withDefault();
    }

    public function exammark()
    {
        return $this->hasMany(ExamMark::class);
    }

    public function rollcallmoshaver()
    {
        return $this->hasMany(RollCallMoshaver::class);
    }

    public function daftar()
    {
        return $this->hasMany(Daftar::class);
    }

    public function studentjtamrin()
    {
        return $this->hasMany(JTamrin::class);
    }

    public function rollcalldaftar()
    {
        return $this->hasMany(RollCall::class);
    }

    public function moshaversabt()
    {
        return $this->hasMany(MoshaverSabt::class);
    }

    public function finance()
    {
        return $this->hasOne(Finanace::class)->withDefault();
    }

    public function log_finance()
    {
        return $this->hasOne(LogFinanace::class);
    }

    public function karnameadmin()
    {
        return $this->hasMany(KarnamehAdmin::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('l_name', 'asc');
        });
    }

    public function online_list()
    {
        return $this->hasMany(Onlinelist::class);
    }
    public function block_class()
    {
        return $this->hasMany(BlockClassUser::class);
    }


}
