<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;

class ProfileController extends Controller{
    //以下を追加
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);

        $profile = new Profile;
        $form = $request->all();

        unset($form['_token']);

        $profile->fill($form);
        $profile->save();

        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) { 
        abort(404);    
        }
        return view('admin.profile.edit', ['profile_form' => $profile ]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);

        $profile->fill($profile_form)->save();

        return redirect('admin/profile');
    }
}
