<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\ConversationsRepository;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends ParentController
{
    private $conversationsRepo = null;
    public function __construct(ConversationsRepository $conversationsRepo)
    {
        parent::__construct();
        $this->conversationsRepo = $conversationsRepo;
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
            $this->conversationsRepo->sendMessage($request->messageAttrs());
            return redirect()->back()->with('success','Message sent successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
