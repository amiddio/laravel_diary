<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserObserver
{

    const AVATAR_FILE_SYMBOLS_LENGTH = 25;

    private string $storage_dir;

    public function __construct()
    {
        $this->storage_dir = config('custom.path.user_avatar');
    }

    /**
     * Handle the User "saving" event.
     */
    public function saving(User $user): void
    {
        // Saving avatar file to storage
        if (request()->has('avatar')) {

            $generate_avatar_filename = function (User $user) {
                $image = request()->file('avatar');
                return $user->getKey() . '_' . Str::random(self::AVATAR_FILE_SYMBOLS_LENGTH) . '.' . $image->getClientOriginalExtension();
            };

            $path = Storage::putFileAs(
                $this->storage_dir,
                request()->file('avatar'),
                $generate_avatar_filename($user)
            );

            $user->setAttribute('avatar', File::basename($path));
        }

        // Delete avatar from storage and model
        if (request()->has('delete_avatar')) {
            Storage::delete($this->storage_dir . '/' . $user->avatar);
            $user->setAttribute('avatar', null);
        }
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(User $user): void
    {
        // Delete avatar file from storage before user delete
        if ($user->avatar) {
            $avatar_file_path = $this->storage_dir . '/' . $user->avatar;
            if (Storage::exists($avatar_file_path)) {
                Storage::delete($avatar_file_path);
            }
        }
    }
}
