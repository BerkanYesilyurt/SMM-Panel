<?php

namespace App\Http\Controllers\admin;

use App\Enums\TicketStatusEnum;
use App\Enums\UserBanTypesEnum;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Models\UserBan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class BanController extends Controller
{
    public function banPage(User $user, $type)
    {
        return view('pages.admin.ban', [
            'user' => $user,
            'type' => in_array($type, UserBanTypesEnum::values()) ? $type : NULL
        ]);
    }

    public function ban(Request $request)
    {
        $fields = $request->validate([
            'user_id' => ['required', Rule::exists('users','id')],
            'type' => [new Enum(UserBanTypesEnum::class), Rule::unique('user_bans','type')->where(function ($query) use ($request){
                $query->where('user_id', $request->user_id);
            })],
            'permanent' => 'required|boolean',
            'until_at' => 'required|date|date_format:Y-m-d',
            'ticketOptions' => 'required_if:type,=,ticket|in:close,delete'
        ]);

        if($request->has('ticketOptions')){
            if($request->ticketOptions == 'close'){
                DB::transaction(function () use($request){
                    Ticket::where('user_id', $request->user_id)->update(['status' => TicketStatusEnum::CLOSED->value]);
                    TicketMessage::where('user_id', $request->user_id)->update(['seen_by_support' => 1]);
                });
            }elseif ($request->ticketOptions == 'delete'){
                Ticket::where('user_id', $request->user_id)->delete();
            }
        }

        UserBan::create($fields);
        return back()->with('message', 'You have successfully banned the user.');
    }

    public function deleteBan(Request $request)
    {
        $request->validate([
            'type' => new Enum(UserBanTypesEnum::class),
            'user_id' => ['required', Rule::exists('user_bans','user_id')->where(function ($query) use ($request){
                $query->where('type', $request->type);
            })]
        ]);

        UserBan::where('user_id', $request->user_id)->where('type', $request->type)->delete();
        return back()->with('message', 'You have successfully deleted the ban.');
    }
}
