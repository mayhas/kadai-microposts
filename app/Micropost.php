<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id', 'filename'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // micropostを削除する時に全てのBookmarkを外す(削除)
    public function all_unbookmark($micropostId)
    {
        // Bookmark登録されているかの確認
        $count = \DB::select("SELECT count(*) FROM user_bookmark WHERE bookmark_id = ?", [$micropostId]);

        if ($count != 0) {
            // Bookmark登録されていればフォローを外す
            \DB::delete("DELETE FROM user_bookmark WHERE bookmark_id = ?", [$micropostId]);
            return true;
        } else {
            // 未登録であれば何もしない
            return false;
        }
    }

}
