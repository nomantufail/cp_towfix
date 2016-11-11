<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Libs\Helpers\Helper;
use App\Models\Message;
use App\Models\MessageImage;
use App\Models\Product;
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
        $messageImagesTable = (new MessageImagesRepository(new MessageImage()))->getModel()->getTable();
        $messagesCollection = $this->getModel()
            ->where(function ($query) use($userId1, $userId2) {
                $query->where('sender_id', '=', $userId1)
                    ->where('receiver_id', '=', $userId2);
            })
            ->orWhere(function ($query) use($userId1, $userId2){
                $query->where('sender_id', '=', $userId2)
                    ->where('receiver_id', '=', $userId1);
            })
            ->leftJoin($messageImagesTable, $this->getModel()->getTable().".id", '=', $messageImagesTable.'.message_id')
            ->orderBy($this->getModel()->getTable().".id", 'asc')
            ->select($this->getModel()->getTable().".id",'sender_id','receiver_id','message',$this->getModel()->getTable().".created_at", $messageImagesTable.".path")
            ->get();

        $grouped = $messagesCollection->groupBy('id');
        return $grouped;
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