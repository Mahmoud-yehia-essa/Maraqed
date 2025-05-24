<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Laravel\Sanctum\PersonalAccessToken;


class UserController extends Controller
{
    //
    public function allUsers()
    {

        $users = User::latest()->get();

        return view('admin.users.all_users',compact('users'));

    }

    public function addUser()
    {
        return view('admin.users.add_user');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit_user',compact('user'));
    }


    public function editUserStore(Request $request)
    {



        $user_id = $request->id;
        $old_Photo = $request->old_Photo;

        $user = User::findOrFail($user_id);





        $request->validate([
            'Name' => 'required|string',
            'Photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',



        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',






            'Photo.image' => 'يجب أن يكون الملف صورة.',
            'Photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',

        ]);



        $pathPhoto = 'users/'.$old_Photo;




        if ($request->file('Photo')) {


            $file = $request->file('Photo');
            $filename = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users'), $filename);


            if (file_exists($pathPhoto) && $old_Photo != "" ) {
                unlink($pathPhoto);
             }


             $user->Photo = $filename;








        }








        $user->Name = $request->Name;
        $user->Tel = $request->Tel;
        $user->email = $request->email;
        $user->Tel2 = $request->Tel2;
        $user->role = $request->role;

        if($request->password != "")
        {
            $password = Hash::make($request->password);
        $user->password = $password;


        }



        $user->save();

        $notification = array(
            'message' => 'تم التعديل',
            'alert-type' => 'success'
        );
        return redirect()->route('all.users')->with($notification);











    }




    public function addUserStore(Request $request)
    {


        $request->validate([
            'Name' => 'required|string',
            'Photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',



        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',






            'Photo.image' => 'يجب أن يكون الملف صورة.',
            'Photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',

        ]);





        $password = "";

        if($request->password != "")
        {
            $password = Hash::make($request->password);


        }



        $filenamePhoto = "";

        if ($request->file('Photo')) {
            // $file = $request->file('photo');
            // $filename = date('YmdHi').$file->getClientOriginalName();
            // $file->move(public_path('upload/user_images'),$filename);


            $file = $request->file('Photo');
            $filenamePhoto = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users'), $filenamePhoto);
        }




        User::create([
            'Name' => $request->Name,

            'email' => $request->email,

            'Tel' => $request->Tel,

            'role' => $request->role,
            'Tel2' => $request->Tel2,
            'password' =>  $password,



            'Photo' =>  $filenamePhoto,

        ]);

        $notification = array(
            'message' => 'تم اضافة المستخدم',
            'alert-type' => 'success'
        );

        return redirect()->route('all.users')->with($notification);


        // return $request;

    }



    public function deleteUser($id){


        $user = User::findOrFail($id);
        $Photo = $user->Photo;




        // unlink($img );

      //  return $user->photo;

        $pathPhoto = 'users/'.$user->Photo;

        if ($user->Photo&& file_exists(public_path($pathPhoto))) {
            unlink(public_path($pathPhoto));
        }





        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'تم حذف',
            'alert-type' => 'success'
        );
        return redirect()->route('all.users')->with($notification);

        // return redirect()->back()->with($notification);
    }// End Method


    public function userInactive($id){
        User::findOrFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' => ' غير مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method
      public function userActive($id){
        User::findOrFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' => 'مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    /// Api

    public function getUserByPhoneApi(Request $request)
    {
        $phone = $request->phone;

        $users = User::whereRaw("
            CASE
                WHEN LEFT(REPLACE(Tel, ' ', ''), 1) = '+'
                THEN REPLACE(Tel, ' ', '')
                ELSE CONCAT('+', REPLACE(Tel, ' ', ''))
            END = ?
        ", [$phone])->get();

        return response()->json($users);
    }



    public function getUsers(Request $request)
    {

        // For paganation
        $limit = $request->input('limit', 20); // default to 10 users per page
        $users = User::latest()->paginate($limit);

        return response()->json($users);
    //end  For paganation




    }


    // public function readExcel()
    // {
    //     $path = public_path('users.xlsx'); // Make sure this file exists

    //     // Start output buffering to capture print_r output
    //     ob_start();
    //     Excel::import(new ExcelImport, $path);
    //     $output = ob_get_clean();

    //     return "<pre>$output</pre>";
    // }


    public function readExcel()
{
    $path = public_path('users.xlsx');
    \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\ExcelImport, $path);

    return "Users imported into Name and Tel columns successfully!";
}



public function registerApi(Request $request) {

    // Create user
    $userCreated = User::create([
        'Name' => $request->Name,
        'Tel' => $request->Tel,
        'email' => $request->email,
        'Tel2' => $request->Tel2,
        'Photo' => $request->Photo,
        'status' => $request->status,

    ]);

    if ($userCreated) {
        $token = $userCreated->createToken('ourapptoken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'user' => $userCreated,
            'token' => $token
        ], 201);
    }

    return response()->json([
        'success' => false,
        'message' => 'Registration failed'
    ], 500);
}

    public function uploadImageApi(Request $request)
    {



        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('users/'.$user->photo));
            $filename = 'app-'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('users'),$filename);


            return response()->json(['link' => $filename], 200);

        }

      else {
            return response()->json(['error' => 'Image not provided'], 400);
        }




    }



      public function editUserApi(Request $request)
    {


        $user_id = $request->id;

        $user = User::findOrFail($user_id);








        $user->Name = $request->Name;
        $user->Tel = $request->Tel;
        $user->email = $request->email;
        $user->Tel2 = $request->Tel2;



        $user->Photo = $request->Photo;
        // $user->address = $request->address;
        $user->save();





        $token = "Non";

        return response()->json([
            'success' => true,
            'message' => 'updated user successful',
            'user' => $user, // Return all user data
            'token' => $token
        ], 200);







    }

   public function uploadUpadteImageApi(Request $request,$user_id)
    {


        $user = User::find($user_id);

                $imageFolder = $request->imageFolder;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            // @unlink(public_path('users/'.$user->Photo));
                        @unlink(public_path($imageFolder.'/'.$user->Photo));

            $filename = 'app-'.date('YmdHi').$file->getClientOriginalName();
                        $file->move(public_path($imageFolder),$filename);

            // $file->move(public_path('users'),$filename);


            return response()->json(['link' => $filename], 200);

        }

      else {
            return response()->json(['error' => 'Image not provided'], 400);
        }




    }


     public function deleteUserApi(Request $request){



    $id = $request->delet_user_id;

        $user = User::findOrFail($id);

        $img = $user->Photo;

        // unlink($img );

      //  return $user->photo;

        $path = 'users/'.$user->Photo;
        if ($user->Photo && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
        User::findOrFail($id)->delete();

    return response()->json([
                'success' => true,
                'message' => 'user deleted successful',


            ], 200);

        // return redirect()->back()->with($notification);
    }// End Method


        public function getAllUserByNameApi(Request $request)
    {


                $keyWord = $request->Name;

        $normalizedKey = $this->normalizeArabic($keyWord);

        $users = User::whereRaw("REPLACE(REPLACE(REPLACE(LOWER(Name), 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا') LIKE ?", ['%' . $normalizedKey . '%'])
            ->orderByRaw("CASE
                            WHEN LOWER(SUBSTRING_INDEX(REPLACE(REPLACE(REPLACE(Name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), ' ', 1)) = ?
                            THEN 0
                            ELSE 1
                         END", [$normalizedKey])
            ->get();

        return response()->json($users);
    }

    private function normalizeArabic($text)
{
    $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
    return mb_strtolower($text);
}




}
