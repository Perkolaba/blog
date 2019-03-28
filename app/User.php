<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    const IS_ADMIN = 1;
    const IS_NOT_ADMIN = 0;
    const IS_BANNED = 1;
    const IS_UNBANNED = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {

        return $this->hasMany(Post::class);

    }

    public function comments() {

        return $this->hasMany(Comment::class);
    }

    public static function add($fields) {

        $user = new static();
        $user->fill($fields);

        return $user;
    }

    public function edit($fields) {

        $this->fill($fields);
        $this->save();

    }

    public function generatePassword($password) {
        if($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove() {

        $this->removeAvatar();
        $this->delete();

    }

    public function uploadAvatar($image) {

        if ($image==null) {return;}

        $this->removeAvatar();
        $filename = str_random(10). '.' .$image->extension();
        $image->storeAs('uploads/', $filename);
        $this->avatar = $filename;
        $this->save();

    }

    public function removeAvatar() {

        if($this->avatar != null) {
            Storage::delete('uploads/'. $this->avatar);
        }

    }

    public function getAvatar() {

        if ($this->avatar ==null) {

            return '/img/no-user-avatar.png';
        }

        return '/uploads/'. $this->avatar;

    }

    public function makeAdmin() {

        $this->is_admin = USER::IS_ADMIN;
        $this->save();

    }

    public function makeNormalUser() {

        $this->is_admin = USER::IS_NOT_ADMIN;
        $this->save();

    }

    public function toggleAdmin($value) {

        if ($value == null) {

            return $this->makeNormalUser();

        }

            return $this->makeAdmin();

    }

    public function ban() {

        $this->status = USER::IS_BANNED;
        $this->save();

    }

    public function unBan() {

        $this->status = USER::IS_UNBANNED;
        $this->save();

    }

    public function toggleBan($value) {

        if ($value == USER::IS_BANNED) {

            $this->unBan();
        }

        else {
        $this->ban();
        }

    }
}
