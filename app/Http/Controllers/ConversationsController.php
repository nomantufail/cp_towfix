<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\ConversationsRepository;
use App\Repositories\MessageImagesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConversationsController extends ParentController
{
    private $conversationsRepo = null;
    private $messageImages = null;
    public function __construct(ConversationsRepository $conversationsRepo , MessageImagesRepository $messageImagesRepo)
    {
        parent::__construct();
        $this->conversationsRepo = $conversationsRepo;
        $this->messageImages = $messageImagesRepo;
    }

    public function users(Requests\Conversations\ShowMessagesPageRequest $request)
    {
        $data = [
            'messages' => [],
            'users' => $this->usersRepo->getByIds($this->conversationsRepo->getEngagedUserIds(Auth::user()->id))
        ];
        return view('conversations.list-engaged-users', $data);
    }

    public function userMessages(Requests\Conversations\ListUserMessagesRequest $request, $engagedUserId)
    {
        return view('conversations.list-user-messages', [
            'messages' => $this->conversationsRepo->userMessages($engagedUserId, Auth::user()->id),
            'users' => $this->usersRepo->getByIds($this->conversationsRepo->getEngagedUserIds(Auth::user()->id)),
            'engagedUser' => $this->usersRepo->findById($engagedUserId)
        ]);
    }

    public function create()
    {
        $data = [
            'receivers' => (Auth::user()->isCustomer())?$this->usersRepo->franchises():$this->usersRepo->customers()
        ];
        return view('conversations.create-message-form', $data);
    }

    public function send(Requests\Conversations\SendMessageRequest $request)
    {

        try{
            $message_id = $this->conversationsRepo->sendMessage($request->messageAttrs())->id;
            $message_images = [];

            if($request->file('images') != null) {
                foreach ($request->file('images') as $file) {
                    $public_path = '/images/messages/' . $message_id;
                    $destinationPath = public_path($public_path);
                    $filename = $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $message_images[] = [
                        'message_id' => $message_id,
                        'path' => $public_path . '/' . $filename
                    ];
                }
                $this->messageImages->insertMultiple($message_images);
            }
        return redirect()->route('user_messages', array('user_id' => $request->messageAttrs()['receiver_id']))->with('success','Message sent successfully');

        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
