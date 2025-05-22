<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;


class TombController extends Controller
{
    //

    public function allTomb()
    {
        $tombs = Tomb::latest()->get();

        return view('admin.tomb.all_tomb',compact('tombs'));
    }

    public function addTomb()
    {

        return view('admin.tomb.add_tomb');
    }

    public function addTombStore(Request $request)
    {


        $request->validate([
            'Name' => 'required|string',
            'DeathDate' => 'required|string',
            'BirtDate' => 'required|string',
            // 'Vertical' => 'required|string',
            // 'Horizontal' => 'required|string',
            // 'TombNumber' => 'required|string',
            // 'TombPlace' => 'required|string',
            // 'Latitude' => 'required|string',

            // 'Longitude' => 'required|string',

            'Photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',
            'DeathPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',

        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',

            'DeathDate.required' => 'حقل تاريخ الوفاة مطلوب.',
            'BirtDate.required' => 'حقل العمر مطلوب.',


            'Vertical.required' => 'حقل عمودي مطلوب.',
            'Horizontal.required' => 'حقل أفقي مطلوب.',
            'Horizontal.required' => 'حقل أفقي مطلوب.',







            'Photo2.image' => 'يجب أن يكون الملف صورة.',
            'Photo2.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo2.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت.',



            'DeathPhoto.image' => 'يجب أن يكون شهادة الوفاة صورة.',
            'DeathPhoto.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'DeathPhoto.max' => 'يجب ألا يتجاوز حجم شهادة الوفاة 2 ميغابايت.',
        ]);



        $filenamePhoto2 = "non.jpg";

        if ($request->file('Photo2')) {
            // $file = $request->file('photo');
            // $filename = date('YmdHi').$file->getClientOriginalName();
            // $file->move(public_path('upload/user_images'),$filename);


            $file = $request->file('Photo2');
            $filenamePhoto2 = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos2'), $filenamePhoto2);
        }


        $filenameDeathPhoto = "non.jpg";

        if ($request->file('DeathPhoto')) {
            // $file = $request->file('photo');
            // $filename = date('YmdHi').$file->getClientOriginalName();
            // $file->move(public_path('upload/user_images'),$filename);


            $file = $request->file('DeathPhoto');
            $filenameDeathPhoto = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('death_photos'), $filenameDeathPhoto);
        }

        // 'TombNumber' => 'required|string',
        // 'TombPlace' => 'required|string',
        // 'Latitude' => 'required|string',

        // 'Longitude' => 'required|string',

        Tomb::create([
            'Name' => $request->Name,
            'DeathDate' => $request->DeathDate,

            'BirtDate' => $request->BirtDate,
            'Vertical' => $request->Vertical,
            'Horizontal' => $request->Horizontal,
            'TombNumber' => $request->TombNumber,
            'Latitude' => $request->Latitude,
            'Longitude' => $request->Longitude,
            'Photo2' =>  $filenamePhoto2,
            'DeathPhoto' => $filenameDeathPhoto,

        ]);

        $notification = array(
            'message' => 'تم اضافة القبر',
            'alert-type' => 'success'
        );

        return redirect()->route('all.tomb')->with($notification);


        // return $request;

    }


    public function editTomb($id)
    {

        $tomb = Tomb::findOrFail($id);






        return view('admin.tomb.edit_tomb',compact('tomb'));





    }




    public function editTombStore(Request $request)
    {


        $tomb_id = $request->id;
        $old_Photo2 = $request->old_Photo2;
        $old_DeathPhoto = $request->old_DeathPhoto;

        $tomb = Tomb::findOrFail($tomb_id);


        $request->validate([
            'Name' => 'required|string',
            'DeathDate' => 'required|string',
            'BirtDate' => 'required|string',
            // 'Vertical' => 'required|string',
            // 'Horizontal' => 'required|string',
            // 'TombNumber' => 'required|string',
            // 'TombPlace' => 'required|string',
            // 'Latitude' => 'required|string',

            // 'Longitude' => 'required|string',

            'Photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',
            'DeathPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',

        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',

            'DeathDate.required' => 'حقل تاريخ الوفاة مطلوب.',
            'BirtDate.required' => 'حقل العمر مطلوب.',


            'Vertical.required' => 'حقل عمودي مطلوب.',
            'Horizontal.required' => 'حقل أفقي مطلوب.',
            'Horizontal.required' => 'حقل أفقي مطلوب.',







            'Photo2.image' => 'يجب أن يكون الملف صورة.',
            'Photo2.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo2.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت.',



            'DeathPhoto.image' => 'يجب أن يكون شهادة الوفاة صورة.',
            'DeathPhoto.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'DeathPhoto.max' => 'يجب ألا يتجاوز حجم شهادة الوفاة 2 ميغابايت.',
        ]);




        // $filename = "";

        $pathPhoto2 = 'photos2/'.$old_Photo2;




        if ($request->file('Photo2')) {


            $file = $request->file('Photo2');
            $filename = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos2'), $filename);


            if (file_exists($pathPhoto2) && $old_Photo2 != "" ) {
                unlink($pathPhoto2);
             }


             $tomb->Photo2 = $filename;








        }


        $pathDeathPhoto = 'death_photos/'.$old_DeathPhoto;




        if ($request->file('DeathPhoto')) {


            $file = $request->file('DeathPhoto');
            $filename = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('death_photos'), $filename);


            if (file_exists($pathDeathPhoto) && $old_DeathPhoto != "" ) {
                unlink($pathDeathPhoto);
             }


             $tomb->DeathPhoto = $filename;








        }


        $tomb->Name = $request->Name;
        $tomb->DeathDate = $request->DeathDate;
        $tomb->BirtDate = $request->BirtDate;
        $tomb->Vertical = $request->Vertical;
        $tomb->Horizontal = $request->Horizontal;
        $tomb->TombNumber = $request->TombNumber;
        $tomb->TombPlace = $request->TombPlace;
        $tomb->Latitude = $request->Latitude;
        $tomb->Longitude = $request->Longitude;

        $tomb->save();

        $notification = array(
            'message' => 'تم التعديل',
            'alert-type' => 'success'
        );
        return redirect()->route('all.tomb')->with($notification);











    }


    public function deleteTomb($id){


        $tomb = Tomb::findOrFail($id);
        $DeathPhoto = $tomb->DeathPhoto;
        $Photo2 = $tomb->Photo2;




        // unlink($img );

      //  return $user->photo;

        $pathDeathPhoto = 'death_photos/'.$tomb->DeathPhoto;

        if ($tomb->DeathPhoto&& file_exists(public_path($pathDeathPhoto))) {
            unlink(public_path($pathDeathPhoto));
        }


        $pathPhoto2 = 'photos2/'.$tomb->Photo2;

        if ($tomb->Photo2 && file_exists(public_path($pathPhoto2))) {
            unlink(public_path($pathPhoto2));
        }


        Tomb::findOrFail($id)->delete();
        $notification = array(
            'message' => 'تم حذف',
            'alert-type' => 'success'
        );
        return redirect()->route('all.tomb')->with($notification);

        // return redirect()->back()->with($notification);
    }// End Method



    public function showFrontEndTomb($id)
    {

        $tomb = Tomb::findOrFail($id);

        return view('frontend.tomb.tomb',compact('tomb'));
    }


    public function tombInactive($id){
        Tomb::findOrFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' => ' غير مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method
      public function tombActive($id){
        Tomb::findOrFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' => 'مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method



    /// API

    public function searchTombApi(Request $request)
    {
        // $keyWord = $request->keyWord;

        // // Use 'LIKE' for partial matching
        // $getSearchResult = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')->get();

        // // Return the result as JSON
        // return response()->json($getSearchResult);





        // $keyWord = $request->keyWord;

        // $results = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')
        //     ->orderByRaw("CASE
        //                     WHEN LOWER(SUBSTRING_INDEX(Name, ' ', 1)) = ? THEN 0
        //                     ELSE 1
        //                  END", [strtolower($keyWord)])
        //     ->get();

        // return response()->json($results);



        $keyWord = $request->keyWord;

        // Normalize Arabic characters for matching
        $normalizedKey = $this->normalizeArabic($keyWord);






        $results = Tomb::whereRaw("REPLACE(REPLACE(REPLACE(LOWER(Name), 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا') LIKE ?", ['%' . $normalizedKey . '%'])
            ->orderByRaw("CASE
                            WHEN LOWER(SUBSTRING_INDEX(REPLACE(REPLACE(REPLACE(Name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), ' ', 1)) = ?
                            THEN 0
                            ELSE 1
                         END", [$normalizedKey])
            ->get();


        return response()->json($results);


    }



    public function searchTombByPlaceApi(Request $request)
    {
        // $keyWord = $request->keyWord;

        // // Use 'LIKE' for partial matching
        // $getSearchResult = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')->get();

        // // Return the result as JSON
        // return response()->json($getSearchResult);





        // $keyWord = $request->keyWord;

        // $results = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')
        //     ->orderByRaw("CASE
        //                     WHEN LOWER(SUBSTRING_INDEX(Name, ' ', 1)) = ? THEN 0
        //                     ELSE 1
        //                  END", [strtolower($keyWord)])
        //     ->get();

        // return response()->json($results);



        $keyWord = $request->keyWord;

        // Normalize Arabic characters for matching
        $normalizedKey = $this->normalizeArabic($keyWord);






        $results = Tomb::whereRaw("REPLACE(REPLACE(REPLACE(LOWER(TombPlace), 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا') LIKE ?", ['%' . $normalizedKey . '%'])
            ->orderByRaw("CASE
                            WHEN LOWER(SUBSTRING_INDEX(REPLACE(REPLACE(REPLACE(Name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), ' ', 1)) = ?
                            THEN 0
                            ELSE 1
                         END", [$normalizedKey])
            ->get();



        return response()->json($results);




    }


    public function searchTombByBlockApi(Request $request)
    {
        // $keyWord = $request->keyWord;

        // // Use 'LIKE' for partial matching
        // $getSearchResult = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')->get();

        // // Return the result as JSON
        // return response()->json($getSearchResult);





        // $keyWord = $request->keyWord;

        // $results = Tomb::where('Name', 'LIKE', '%' . $keyWord . '%')
        //     ->orderByRaw("CASE
        //                     WHEN LOWER(SUBSTRING_INDEX(Name, ' ', 1)) = ? THEN 0
        //                     ELSE 1
        //                  END", [strtolower($keyWord)])
        //     ->get();

        // return response()->json($results);




        /*
        $keyWord = $request->keyWord;

        // Normalize Arabic characters for matching
        $normalizedKey = $this->normalizeArabic($keyWord);






        $results = Tomb::whereRaw("REPLACE(REPLACE(REPLACE(LOWER(BlockNumber), 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا') LIKE ?", ['%' . $normalizedKey . '%'])
            ->orderByRaw("CASE
                            WHEN LOWER(SUBSTRING_INDEX(REPLACE(REPLACE(REPLACE(Name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), ' ', 1)) = ?
                            THEN 0
                            ELSE 1
                         END", [$normalizedKey])
            ->get();



        return response()->json($results);

*/



 $keyWord = $request->keyWord;

        $results = Tomb::where('BlockNumber',$keyWord)->get();

        return response()->json($results);


    }

    // Helper function to normalize Arabic letters
private function normalizeArabic($text)
{
    $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
    return mb_strtolower($text);
}





// public function searchTombByDateApi(Request $request)
// {
//     $keyWord = $request->keyWord;

//     // Get all records first
//     $results = Tomb::all()->map(function ($item) use ($keyWord) {
//         // Mark valid if exact match
//         $item->valid = ($item->DeathDate === $keyWord);

//         // Add a sortable date field
//         try {
//             $item->parsedDeathDate = Carbon::createFromFormat('d/m/Y', $item->DeathDate);
//         } catch (\Exception $e) {
//             $item->parsedDeathDate = null; // Handle invalid formats safely
//         }

//         return $item;
//     });

//     // Sort by parsedDeathDate descending (newest first)
//     $sortedResults = $results->sortByDesc('parsedDeathDate')->values();

//     return response()->json($sortedResults);
// }


public function searchTombByDateApi(Request $request)
{
    $keyWord = $request->keyWord;
    $limit = (int) $request->limit; // default is 0 if not set

    // Get all records first
    $results = Tomb::all()->map(function ($item) use ($keyWord) {
        // Mark valid if exact match
        $item->valid = ($item->DeathDate === $keyWord);

        // Add a sortable date field
        try {
            $item->parsedDeathDate = Carbon::createFromFormat('d/m/Y', $item->DeathDate);
        } catch (\Exception $e) {
            $item->parsedDeathDate = null; // Handle invalid formats safely
        }

        return $item;
    });

    // Sort by parsedDeathDate descending (newest first)
    $sortedResults = $results->sortByDesc('parsedDeathDate')->values();

    // Apply limit if it's greater than 0
    if ($limit > 0) {
        $sortedResults = $sortedResults->take($limit);
    }

    return response()->json($sortedResults);
}




    public function addTombApi(Request $request) {


    // Create user
    $tombCreated = Tomb::create([
       'Name' => $request->Name,
            'DeathDate' => $request->DeathDate,

            'BirtDate' => $request->BirtDate,
            'Vertical' => $request->Vertical,
            'Horizontal' => $request->Horizontal,
            'TombNumber' => $request->TombNumber,
            'Latitude' => $request->Latitude,
            'Longitude' => $request->Longitude,
            'Photo2' =>  $request->Photo2,
            'DeathPhoto' => $request->DeathPhoto,
            'BlockNumber' => $request->BlockNumber,
            'TombPlace' => $request->TombPlace,




    ]);

    if ($tombCreated) {

        return response()->json([
            'success' => true,
            'message' => 'tomb Created successful',
            'tomb' => $tombCreated,
        ], 201);
    }

    return response()->json([
        'success' => false,
        'message' => 'Registration failed'
    ], 500);
}

  public function uploadImageDeathApi(Request $request)
    {



        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('photos2/'.$user->photo));
            $filename = 'app-'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('photos2'),$filename);


            return response()->json(['link' => $filename], 200);

        }

      else {
            return response()->json(['error' => 'Image not provided'], 400);
        }




    }


      public function uploadImageShahedApi(Request $request)
    {



        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('death_photos/'.$user->photo));
            $filename = 'app-'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('death_photos'),$filename);


            return response()->json(['link' => $filename], 200);

        }

      else {
            return response()->json(['error' => 'Image not provided'], 400);
        }




    }




        public function editTombApi(Request $request)
    {


        // return "ok";
        $tomb_id = $request->id;

        $tomb = Tomb::findOrFail($tomb_id);









        $tomb->Name = $request->Name;
        $tomb->DeathDate = $request->DeathDate;
        $tomb->BirtDate = $request->BirtDate;

        $tomb->Vertical = $request->Vertical;

        $tomb->Horizontal = $request->Horizontal;
        $tomb->TombNumber = $request->TombNumber;
        $tomb->Latitude = $request->Latitude;
        $tomb->Longitude = $request->Longitude;
        $tomb->Photo2 = $request->Photo2;

         $tomb->DeathPhoto = $request->DeathPhoto;

                  $tomb->BlockNumber = $request->BlockNumber;
                                    $tomb->TombPlace = $request->TombPlace;




        $tomb->save();





        $token = "Non";

        return response()->json([
            'success' => true,
            'message' => 'updated tomb successful',
            'tomb' => $tomb, // Return all user data
            'token' => $token
        ], 200);







    }



      public function uploadUpadteImageApi(Request $request,$id)
    {


        $tomb = Tomb::find($id);
        $imageFolder = $request->imageFolder;



        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path($imageFolder.'/'.$user->Photo));
            $filename = 'app-'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path($imageFolder),$filename);


            return response()->json(['link' => $filename], 200);

        }

      else {
            return response()->json(['error' => 'Image not provided'], 400);
        }




    }


}
