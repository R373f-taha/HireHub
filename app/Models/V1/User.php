<?php
namespace App\Models\V1;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded=[];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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


    public function freelancer(){
        return $this->hasOne(Freelancer::class);
    }
    public function client(){
        return $this->hasOne(Client::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function password(){
        return Attribute::make(
           set: fn($value)=>bcrypt($value)
        );
    }
    public function isFreelancer(){
        return $this->role==='freelancer';
    }


     function isClient(){
        return $this->role==='client';
    }
}
