<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View{
        return view('admin.profile.index');
    }

    public function updateProfile(ProfileUpdateRequest $request) : RedirectResponse{

        $user = Auth::user();

        //FileUploadTrait 'ten Image Bilgilerini Alıyoruz
        $imagePath = $this->uploadImage($request, 'avatar');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->save();

        toastr()->success('Güncelleme İşlemi Başarılı');
        return redirect()->back();
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse{

       $user = Auth::user();

       $user->password = bcrypt($request->password);
       $user->save();

       toastr()->success('Şifre Güncelleme İşlemi Başarılı');
       return redirect()->back();

    }


}
