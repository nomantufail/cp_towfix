<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Libs\Helpers\Helper;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class ConversationsRepository extends Repository
{
    public function __construct(Message $message)
    {
        $this->setModel($message);
    }

    public function sendMessage($attrs)
    {
        return $this->getModel()->create($attrs);
    }

    public function userMessages($userId1, $userId2)
    {
        return $this->getModel()
            ->where(function ($query) use($userId1, $userId2) {
                $query->where('sender_id', '=', $userId1)
                    ->where('receiver_id', '=', $userId2);
            })
            ->orWhere(function ($query) use($userId1, $userId2){
                $query->where('sender_id', '=', $userId2)
                    ->where('receiver_id', '=', $userId1);
            })
            ->orderBy('id', 'asc')
            ->paginate();
    }

    public function getEngagedUserIds($userId)
    {
        $idObjs = DB::table('conversations')
            ->select(DB::raw("
                ( CASE
                    WHEN conversations.sender_id != ".$userId." THEN
                        conversations.sender_id
                    ELSE
                        conversations.receiver_id
                  END
                ) as engaged_user_id
            "))
            ->where('sender_id', '=', $userId)
            ->orWhere('receiver_id', '=', $userId)
            ->groupBy('engaged_user_id')
            ->get()->toArray();
        return Helper::propertyToArray($idObjs, 'engaged_user_id');
    }
}