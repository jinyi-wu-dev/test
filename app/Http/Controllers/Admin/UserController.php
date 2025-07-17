<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\Prefecture;
use App\Models\User;
use App\Models\LendItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;


class UserController extends Controller
{
    protected function validate($request, $create=false)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => $create ? 'required' : '',
        ]);
    }

    public function query(Request $request) {
        return User::query()
            ->when($request->filled('keywords'), function($query) use($request) {
                $keys = preg_split('/[\s]+/', mb_convert_kana($request->keywords, 's'), -1, PREG_SPLIT_NO_EMPTY);
                foreach ($keys as $key) {
                    $query->orWhere('id', '=', $key);
                    $query->orWhere('name', 'LIKE', '%'.$key.'%');
                    $query->orWhere('email', 'LIKE', '%'.$key.'%');
                }
            });
    }

    public function index(Request $request)
    {
        return view('admin/user/index', [
            'users' => $this->query($request)->paginate(config('pagination.num_of_item'))->withQueryString(),
        ]);
    }

    public function csv(Request $request) {
        $users = $this->query($request)->get();
        return new StreamedResponse(function () use ($users) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'メールアドレス',
                '名前',
                'フリガナ',
                '郵便番号',
                '都道府県',
                '市町村区',
                '番地',
                'ビル名',
                '電話番号',
                '会社名',
                '部署',
                '役職',
                '業種',
                '職種',
            ], 'cp932', 'utf8'));
            foreach ($users as $user) {
                fputcsv($fh, mb_convert_encoding([
                    $user->id,
                    $user->email,
                    $user->name,
                    $user->kana,
                    $user->postal_code,
                    $user->prefecture==Prefecture::FOREIGN ? 
                        $user->country :
                        $user->prefecture->label(),
                    $user->city,
                    $user->area,
                    $user->building,
                    $user->phone_number,
                    $user->company,
                    $user->department,
                    $user->positionsString(),
                    $user->industriesString(),
                    $user->occupationesString(),
                ], 'cp932', 'utf8'));
            }

            fclose($fh);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }

    public function create()
    {
        return view('admin/user/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, true);

        $user = new User($request->all());
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $user->id));
    }

    public function show(User $user)
    {
        return $this->edit($user);
    }

    public function edit(User $user)
    {
        return view('admin/user/edit', [
            'user'          => $user,
            'lend_items'    => LendItem::where('user_id', $user->id)->get(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request);

        $user->fill($request->except('password'));
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $user->id));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('admin.user.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $user->id));
    }
}
