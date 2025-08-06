<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Enums\Prefecture;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Symfony\Component\Mime\Address;
use Validator;

class ContactController extends Controller
{
    protected function rules($confirm=false) {
        return [
            'type' => 'required',
            'name' => 'required',
            'kana' => 'required',
            'postal_code' => 'required',
            'prefecture' => 'required',
            'country' => 'required_if:prefecture,foreign',
            'city' => 'required',
            'area' => 'required',
            'building' => 'required',
            'phone_number' => 'required',
            'company' => 'required',
            'department' => 'required',
            'email' => 'required',
            'contents' => 'required',
            'agree' => $confirm ? 'required' : '',
        ];
    }

    protected function sendMailToUser(Contact $contact) {
        Mail::raw(
            str_replace([
                '{name}',
                '{type}',
                '{kana}',
                '{postal_code}',
                '{prefecture}',
                '{city}',
                '{area}',
                '{building}',
                '{phone_number}',
                '{company}',
                '{department}',
                '{email}',
                '{contents}',
            ], [
                $contact->name,
                $contact->type,
                $contact->kana,
                $contact->postal_code,
                $contact->prefecture==Prefecture::FOREIGN ? $contact->country : $contact->prefecture->label(),
                $contact->city,
                $contact->area,
                $contact->building,
                $contact->phone_number,
                $contact->company,
                $contact->department,
                $contact->email,
                $contact->contents,
            ],
            config('contact_mail_to_user.body')), function (Message $message) {
                $message
                    ->to([new Address('kouno@wecsy.co.jp', 'kouno')])
                    ->subject(config('contact_mail_to_user.subject'));
        });
    }

    protected function sendMailToAdmin(Contact $contact) {
        $weeks = array( "日", "月", "火", "水", "木", "金", "土" );
        $week = $weeks[date("w", strtotime($contact->created_at))];
        Mail::raw(
            str_replace([
                '{date}',
                '{name}',
                '{type}',
                '{kana}',
                '{postal_code}',
                '{prefecture}',
                '{city}',
                '{area}',
                '{building}',
                '{phone_number}',
                '{company}',
                '{department}',
                '{email}',
                '{contents}',
            ], [
                date("Y年m月d日（{$week}）H:i:s"),
                $contact->name,
                $contact->type,
                $contact->kana,
                $contact->postal_code,
                $contact->prefecture==Prefecture::FOREIGN ? $contact->country : $contact->prefecture->label(),
                $contact->city,
                $contact->area,
                $contact->building,
                $contact->phone_number,
                $contact->company,
                $contact->department,
                $contact->email,
                $contact->contents,
            ],
            config('contact_mail_to_admin.body')), function (Message $message) {
                $message
                    ->to([new Address('kouno@wecsy.co.jp', 'kouno')])
                    ->subject(config('contact_mail_to_admin.subject'));
        });
    }

    public function index()
    {
        $user = null;
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
        }
        return $this->languageView("contact", [
            'user' => $user,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(true));
        return $this->languageView("contact_confirm");
    }

    public function complete(Request $request)
    {
        $v = Validator::make($request->all(), $this->rules(false));
        if ($v->fails() || $request->back) {
            return redirect()->route('contact')->withInput();
        }

        $contact = new Contact($request->all());
        $contact->save();

        $this->sendMailToUser($contact);
        $this->sendMailToAdmin($contact);

        return $this->languageView("contact_complete");
    }

}
