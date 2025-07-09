<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LendItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('name'), function($query) use($request) {
                $query->whereLike('name', '%'.$request->name.'%');
            })
            ->paginate(config('pagination.num_of_item'))
            ->withQueryString();
        return view('admin/user/index', [
            'users' => $users,
        ]);
    }

    public function csv() {
        $users = User::get();

        $header = [''];
        $data = $users->toArray();
        return new StreamedResponse(function () use ($header, $users) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, $header);
            foreach ($users as $row) {
                fputcsv($fh, $row->toArray());
            }

            fclose($fh);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }

    protected function validate($request, $create=false)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => $create ? 'required' : '',
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
