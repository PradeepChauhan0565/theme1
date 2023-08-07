<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBotComponent extends Component
{

    public $chat_user_id;
    public $message_body;
    public $messages = [];
    public $message_list = [];
    public $user;
    public $users = [];
    public $room_id;
    public $rooms = [];
    public $is_open = false;
    public $contacts = [];
    public $highlightIndex;
    public $query_chat_user;


    protected $listeners = [
        'chatOpen',
        'chatClose'
    ];

    public function mount()
    {
        $this->getRooms();
    }

    public function getRooms()
    {
        if (Auth::check()) {
            $this->rooms = User::find(Auth::user()->id)->rooms;
        }
    }
    public function chatOpen()
    {
        $this->is_open = true;
    }

    public function chatClose()
    {
        $this->is_open = false;
    }

    public function chatClick($id)
    {
        $this->room_id = $id;
        Message::where('room_id', $id)->where('sender_id', '!=', Auth::user()->id)->update(['is_seen' => 1]);
        $this->getNewChat();
        $this->user = Room::where('id', $id)->where('has_group', 0)->first()->users->where('id', '!=', Auth::user()->id)->first()->name ?? null;
        $this->dispatchBrowserEvent('chatScrollBottom');
    }
    public function getTableId()
    {
        $rooms = User::find(Auth::user()->id)->rooms()->where('has_group', 0)->pluck('room_id');
        $exist = RoomUser::whereIn('room_id', $rooms)->where('user_id', $this->chat_user_id)->first();
        if (!$exist) {
            $room =  Room::create([
                'room_name_id' => $this->chat_user_id,
            ]);
            RoomUser::create([
                'user_id' => Auth::user()->id,
                'room_id' => $room->id,
            ]);
            RoomUser::create(
                [
                    'user_id' => $this->chat_user_id,
                    'room_id' => $room->id,
                ]
            );
            $room_id = $room->id;
        } else {
            $room_id = $exist->room_id;
        }
        $this->room_id = $room_id;
        Message::where('room_id', $room_id)->where('sender_id', '!=', Auth::user()->id)->update(['is_seen' => 1]);
        $this->messages = Message::where('room_id', $room_id)->get();
        $this->user = Room::where('id', $room_id)->where('has_group', 0)->first()->users->where('id', '!=', Auth::user()->id)->first()->name ?? null;
        $this->dispatchBrowserEvent('chatScrollBottom');
    }

    public function backToContact()
    {
        $this->room_id = null;
        $this->user = null;
        $this->rooms = User::find(Auth::user()->id)->rooms;
    }

    public function getNewChat()
    {
        $this->messages = Message::where('room_id', $this->room_id)->get();
        $this->dispatchBrowserEvent('chatScrollBottom');
    }
    public function sendMessage()
    {
        if (strlen(trim($this->message_body)) > 0) {
            Message::create([
                'sender_id' => Auth::user()->id,
                'room_id' => $this->room_id,
                'body' => $this->message_body,
                'is_delivered' => 1,
            ]);
            $this->message_body = null;
            $this->getNewChat();
            $this->dispatchBrowserEvent('chatScrollBottom');
        }
        $this->message_body = null;
    }


    public function reset1()
    {
        $this->query_chat_user = null;
        $this->contacts = [];
        $this->highlightIndex = 0;
    }
    public function setData($id)
    {
        $user = User::find($id);
        $this->query_chat_user = $user->name;
        $this->chat_user_id = $user->id;
        $this->reset1();
        $this->getTableId();
    }

    public function queryClick()
    {
        if (strlen($this->query_chat_user) == 0) {
            $this->contacts = User::orderBy('name', 'asc')
                ->take(15)
                ->get();
        }
    }

    public function updatedQueryChatUser()
    {
        $this->contacts = User::where('name', 'like', '%' . $this->query_chat_user . '%')
            ->orderBy('name', 'asc')
            ->take(15)
            ->get();
    }
    public function render()
    {
        return view('livewire.chat-bot-component');
    }
}
