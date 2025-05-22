<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;


class NewsController extends Controller
{


    public function allNews()
    {
        $news = News::latest()->get();

        return view('admin.news.all_news',compact('news'));
    }

    public function addNews()
    {

        return view('admin.news.add_news');
    }

    public function addNewsStore(Request $request)
    {


        $request->validate([
            'title' => 'required|string',
            'des' => 'required|string',


            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000|required',

        ], [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان  نصًا.',
            'des.required' => 'حقل الوصف مطلوب.',


            'des.string' => 'يجب أن يكون الوصف  نصًا.',




            'photo.required' => 'يجب اضافة صورة ',

            'photo.image' => 'يجب أن يكون الملف صورة.',
            'photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',


        ]);



        $filenamePhoto = "";

        if ($request->file('photo')) {
            // $file = $request->file('photo');
            // $filename = date('YmdHi').$file->getClientOriginalName();
            // $file->move(public_path('upload/user_images'),$filename);


            $file = $request->file('photo');
            $filenamePhoto = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('news'), $filenamePhoto);
        }






        News::create([
            'title' => $request->title,

            'des' => $request->des,

            'photo' =>  $filenamePhoto,

        ]);

        $notification = array(
            'message' => 'تم اضافة الخبر',
            'alert-type' => 'success'
        );

        return redirect()->route('all.news')->with($notification);


        // return $request;

    }


    public function editNews($id)
    {

        $news = News::findOrFail($id);






        return view('admin.news.edit_news',compact('news'));





    }




    public function editNewsStore(Request $request)
    {


        $news_id = $request->id;
        $old_photo = $request->old_photo;

        $news = News::findOrFail($news_id);





        $request->validate([
            'title' => 'required|string',
            'des' => 'required|string',


            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',

        ], [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان  نصًا.',
            'des.required' => 'حقل الوصف مطلوب.',


            'des.string' => 'يجب أن يكون الوصف  نصًا.',





            'Photo.image' => 'يجب أن يكون الملف صورة.',
            'Photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',


        ]);


        // $filename = "";

        $pathPhoto = 'news/'.$old_photo;




        if ($request->file('photo')) {



            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('news'), $filename);


            if (file_exists($pathPhoto) && $old_photo != "" ) {
                unlink($pathPhoto);
             }


             $news->photo = $filename;








        }








        $news->title = $request->title;
        $news->des = $request->des;




        $news->save();

        $notification = array(
            'message' => 'تم التعديل',
            'alert-type' => 'success'
        );
        return redirect()->route('all.news')->with($notification);











    }


    public function deleteNews($id){


        $news = News::findOrFail($id);
        $photo = $news->photo;








        $pathPhoto = 'news/'.$news->photo;

        if ($news->photo && file_exists(public_path($pathPhoto))) {
            unlink(public_path($pathPhoto));
        }


        News::findOrFail($id)->delete();
        $notification = array(
            'message' => 'تم حذف',
            'alert-type' => 'success'
        );
        return redirect()->route('all.news')->with($notification);

        // return redirect()->back()->with($notification);
    }// End Method









     //Api


     public function getNews(Request $request)
     {
         $limit = $request->input('limit', 0); // Default to 0 if not provided

         if ($limit > 0) {
             $news = News::latest()->limit($limit)->get();
         } else {
             $news = News::latest()->get();
         }

         // Add 'time_ago' to each item
         $news->transform(function ($item) {
             $item->time_ago = Carbon::parse($item->created_at)->diffForHumans(null, false, false, 2);
             return $item;
         });

         return response()->json($news);
     }


}
