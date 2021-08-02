<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Validator;
use PDF;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort = 'title';
        $defaultMenu = 0;
        $menus = Menu::all();
        $s = '';
        
        if ($request->sort_by) {
            if ('title' == $request->sort_by) {
                $menus = Menu::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('title' == $request->sort_by) {
                $menus = Menu::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('price' == $request->sort_by) {
                $menus = Menu::orderBy('price')->paginate(15)->withQueryString();
                $sort = 'price';
            } elseif ('price' == $request->sort_by) {
                $menus = Menu::orderBy('price')->paginate(15)->withQueryString();
                $sort = 'price';
            } 
                else { 
                    $menus = Menu::paginate(15)->withQueryString();
            } 
            //FILTRAVIMAS
        }  elseif ($request->menu_id) {
            $menus = Menu::where('menu_id', (int)$request->menu_id)->paginate(15)->withQueryString();
            $defaultMenu = (int)$request->menu_id;
        }
        
        elseif ($request->s) {
            $menus = Menu::where('title', 'like', '%'.$request->s.'%')->paginate(15)->withQueryString();
            $s = $request->s;
        }
        elseif ($request->do_search) {
            $menus = Menu::where('title', 'like', '')->paginate(15)->withQueryString();

        }
        
            else {
            $menus = Menu::paginate(15)->withQueryString();
        }

        
        return view('menu.index', [
        'menus' => $menus,
        'sort' => $sort,
        'menus' => $menus,
        'defaultMenu' => $defaultMenu,
        's' => $s,
    ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('title')->paginate(15)->withQueryString();
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
       [
        'menu_title' => ['required', 'min:2', 'max:64', 'alpha'],
        'menu_price' => ['required', 'numeric', 'gt:0'],
        'menu_weight' => ['required', 'numeric', 'gt:0'],
        'menu_meat' => ['required', 'numeric', 'gt:0'],
        'menu_about' => ['required'],
       ]
);
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

       $menu = new Menu;

       if ($request->has('menu_photo')) {
        $photo = $request->file('menu_photo');
        $imageName = 
        $request->menu_title. '-' .
        $request->menu_price. '-' .
        time(). '.' .
        $photo->getClientOriginalExtension();
        $path = public_path() . '/menus-img/'; // serverio vidinis kelias
        $url = asset('menus-img/'.$imageName); // url narsyklei (isorinis)
        $photo->move($path, $imageName); // is serverio tmp ===> i public folderi
        $menu->photo = $url;
    }


        $menu = new Menu;
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.show', ['menu' => $menu]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        if ($request->has('delete_menu_photo')) {
            if ($menu->photo) {
                $imageName = explode('/', $menu->photo);
                $imageName = array_pop($imageName);
                $path = public_path() . '/menus-img/' . $imageName;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $menu->photo = null;
        }

       if ($request->has('menu_photo')) {

        if ($menu->photo) {
            $imageName = explode('/', $menu->photo);
            $imageName = array_pop($imageName);
            $path = public_path() . '/menus-img/' . $imageName;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        
        $photo = $request->file('menu_photo');
        $imageName = 
        $request->menu_title. '-' .
        $request->menu_price. '-' .
        time(). '.' .
        $photo->getClientOriginalExtension();
        $path = public_path() . '/menus-img/'; // serverio vidinis kelias
        $url = asset('/menus-img/'.$imageName); // url narsyklei (isorinis)
        $photo->move($path, $imageName); // is serverio tmp ===> i public folderi
        $menu->photo = $url;
    }
    

        $validator = Validator::make($request->all(),
       [
           'menu_title' => ['required', 'min:2', 'max:64', 'alpha'],
           'menu_price' => ['required', 'numeric', 'gt:0'],
           'menu_weight' => ['required', 'numeric', 'gt:0'],
           'menu_meat' => ['required', 'numeric', 'gt:0'],
           'menu_about' => ['required'],
       ]
   );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sėkmingai pakeistas.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->menuHasRestaurants->count()) {
             return redirect()->back()->with('info_message', 'Trinti negalima, nes turi nebaigtų darbų');
         }
         
        if ($menu->photo) {
            $imageName = explode('/', $menu->photo);
            $imageName = array_pop($imageName);
            $path = public_path() . '/menus-img/' . $imageName;
            if (file_exists($path)) {
                unlink($path);
            }
        }


         $menu->delete();
         return redirect()->route('menu.index')->with('success_message', 'Sekmingai ištrintas.');

    }

    public function pdf(Menu $menu)
    {
        $pdf = PDF::loadView('menu.pdf', ['menu' => $menu]);
        return $pdf->download($menu ->title.'.pdf');
    }

}
