<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\ActivityNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Liste des conversations de l'utilisateur connecté, une ligne par
     * interlocuteur, triée par dernier message envoyé/reçu.
     */
    public function index(): View
    {
        $userId = Auth::id();

        $messages = Message::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->with(['sender.creatif', 'recipient.creatif'])
            ->latest()
            ->get();

        $conversations = $messages
            ->groupBy(fn (Message $m) => $m->sender_id === $userId ? $m->recipient_id : $m->sender_id)
            ->map(function ($group) use ($userId) {
                $last = $group->first();
                $other = $last->sender_id === $userId ? $last->recipient : $last->sender;
                $unread = $group->where('recipient_id', $userId)->whereNull('read_at')->count();

                return (object) [
                    'other' => $other,
                    'last' => $last,
                    'unread' => $unread,
                ];
            })
            ->filter(fn ($c) => $c->other !== null)
            ->sortByDesc(fn ($c) => $c->last->created_at)
            ->values();

        return view('messages.index', compact('conversations'));
    }

    /**
     * Fil de discussion avec un autre utilisateur. Marque ses messages
     * comme lus au passage.
     */
    public function show(User $user): View
    {
        abort_if($user->id === Auth::id(), 404);

        Message::where('sender_id', $user->id)
            ->where('recipient_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = Message::where(function ($q) use ($user) {
                $q->where('sender_id', Auth::id())->where('recipient_id', $user->id);
            })
            ->orWhere(function ($q) use ($user) {
                $q->where('sender_id', $user->id)->where('recipient_id', Auth::id());
            })
            ->oldest()
            ->get();

        return view('messages.show', ['otherUser' => $user, 'messages' => $messages]);
    }

    public function store(Request $request, User $user): RedirectResponse
    {
        abort_if($user->id === Auth::id(), 403);

        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $user->id,
            'body' => $validated['body'],
        ]);

        $user->notify(new ActivityNotification(
            title: 'Nouveau message',
            message: Auth::user()->username . ' vous a envoyé un message.',
            url: route('messages.show', Auth::user()),
            icon: 'message',
        ));

        return back();
    }
}
