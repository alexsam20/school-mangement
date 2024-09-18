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

    public static function getRecords()
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

    public static function getEmailSingle($email)
    {
        return self::where('email', $email)->first();
    }

    public static function getTokenSingle($remember_token)
    {
        return self::where('remember_token', $remember_token)->first();
    }
}
