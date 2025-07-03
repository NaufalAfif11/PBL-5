<?php
    namespace App\Http\controllers;

    use illuminate\https\request;

    class HomeController extends Controller
    
{

    public function undex()
    {
        // $data = [
        //    'nama' => 'Doraemon',
        //    'pekerjaan' => 'Developer',
        // ];
        // return view('home')->with($data);

        $nama = "Nobita";
        $pekerjaan = "Student";
        return view('home', compact('nama', 'pekerjaan'));
    }

    public function contact()
    {
        return view('contact');
    }
}