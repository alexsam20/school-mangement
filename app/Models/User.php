<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'is_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords() // get Admin
    {
        $query = self::select('users.*')
            ->where('user_type', 1)
            ->where('is_delete', 0);
        if (!empty(Request::get('name'))) {
            $query = $query->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $query = $query->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $query = $query->whereDate('created_at', '=', Request::get('date'));
        }
        $query = $query->orderBy('id', 'desc')
            ->paginate(20);

        return $query;
    }

    public static function getTeacher()
    {
        $query = self::select('users.*')
            ->where('user_type', 2)
            ->where('is_delete', 0);

        if (!empty(Request::get('name'))) {
            $query = $query->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $query = $query->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $query = $query->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $query = $query->where('users.gender', Request::get('gender'));
        }
        if (!empty(Request::get('mobile_number'))) {
            $query = $query->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('marital_status'))) {
            $query = $query->where('users.marital_status', 'like', '%' . Request::get('marital_status') . '%');
        }
        if (!empty(Request::get('address'))) {
            $query = $query->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $query = $query->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('created_at'))) {
            $query = $query->whereDate('users.created_at', Request::get('created_at'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $query = $query->where('users.status', $status);
        }
        $query = $query->orderBy('id', 'desc')
            ->paginate(20);

        return $query;
    }

    public static function getTeacherClass()
    {
        return self::select('users.*')
            ->where('user_type', 2)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getParent()
    {
        $query = self::select('users.*')
            ->where('user_type', 4)
            ->where('is_delete', 0);
        if (!empty(Request::get('name'))) {
            $query = $query->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $query = $query->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $query = $query->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $query = $query->where('users.gender', Request::get('gender'));
        }
        if (!empty(Request::get('occupation'))) {
            $query = $query->where('users.occupation', 'like', '%' . Request::get('occupation') . '%');
        }
        if (!empty(Request::get('address'))) {
            $query = $query->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $query = $query->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('created_at'))) {
            $query = $query->whereDate('users.created_at', Request::get('created_at'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $query = $query->where('users.status', $status);
        }
        $query = $query->orderBy('id', 'desc')
            ->paginate(20);

        return $query;
    }

    public static function getStudent()
    {
        $query = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', 3)
            ->where('users.is_delete', 0);
        if (!empty(Request::get('name'))) {
            $query = $query->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $query = $query->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $query = $query->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('admission_name'))) {
            $query = $query->where('users.admission_name', 'like', '%' . Request::get('admission_name') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $query = $query->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $query = $query->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $query = $query->where('users.gender', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $query = $query->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $query = $query->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $query = $query->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $query = $query->where('users.blood_group', 'like', '%' . Request::get('blood_group') . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $query = $query->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('created_at'))) {
            $query = $query->whereDate('users.created_at', '=', Request::get('created_at'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $query = $query->where('users.status', $status);
        }
        $query = $query->orderBy('users.id', 'desc')
            ->paginate(20);

        return $query;
    }

    public static function getSearchStudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) ||
            !empty(Request::get('last_name')) || !empty(Request::get('email'))) {

            $query = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', 3)
                ->where('users.is_delete', 0);
            if (!empty(Request::get('id'))) {
                $query = $query->where('users.id', Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $query = $query->where('users.name', 'like', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $query = $query->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
            }
            if (!empty(Request::get('email'))) {
                $query = $query->where('users.email', 'like', '%' . Request::get('email') . '%');
            }
            $query = $query->orderBy('users.id', 'desc')
                ->limit(50)
                ->get();

            return $query;
        }
    }

    public static function getMyStudent($parent_id)
    {
        return self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', 3)
            ->where('users.parent_id', $parent_id)
            ->where('users.is_delete', 0)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    public static function getEmailSingle($email)
    {
        return self::where('email', $email)->first();
    }

    public static function getTokenSingle($remember_token)
    {
        return self::where('remember_token', $remember_token)->first();
    }

    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
    }
}
