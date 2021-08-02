<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Validator;
use PDF;

class RestaurantController extends Controller
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
        // $restaurants = Restaurant::all();
        
        $sort = 'title';
        $defaultMenu = 0;
        $menus = Menu::all();
        $s = '';
        
        if ($request->sort_by) {
            if ('title' == $request->sort_by) {
                $restaurants = Restaurant::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('title' == $request->sort_by) {
                $restaurants = Restaurant::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('customers' == $request->sort_by) {
                $restaurants = Restaurant::orderBy('customers')->paginate(15)->withQueryString();
                $sort = 'customers';
            } elseif ('customers' == $request->sort_by) {
                $restaurants = Restaurant::orderBy('customers')->paginate(15)->withQueryString();
                $sort = 'customers';
            } 
                else { $restaurants = Restaurant::paginate(15)->withQueryString();
            } 

        }  //FILTRAVIMAS
        elseif ($request->menu_id) {
            $restaurants = Restaurant::where('menu_id', (int)$request->menu_id)->paginate(15)->withQueryString();
            $defaultMenu = (int)$request->menu_id;
        } 
        
        elseif ($request->s) {
            $restaurants = Restaurant::where('title', 'like', '%'.$request->s.'%')->paginate(15)->withQueryString();
            $s = $request->s;
        }
        elseif ($request->do_search) {
            $restaurants = Restaurant::where('title', 'like', '')->paginate(15)->withQueryString();

        }
        else {
            $restaurants = Restaurant::paginate(15)->withQueryString();
        }

        
        return view('restaurant.index', [
        'restaurants' => $restaurants,
        'sort' => $sort,
        'menus' => $menus,
        'defaultMenu' => $defaultMenu,
        's' => $s,
    ]);
    
    // return view('restaurant.index', ['restaurants' => $restaurants]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('title')->paginate(15)->withQueryString();
       return view('restaurant.create', ['menus' => $menus]);

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
           'restaurant_title' => ['required', 'min:3', 'max:64', 'alpha'],
           'restaurant_customers' => ['required', 'min:1', 'numeric'],
           'restaurant_employees' => ['required', 'min:1', 'numeric'],
       ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $restaurant = new Restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurant.show', ['restaurant' => $restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::all();
        return view('restaurant.edit', ['restaurant' => $restaurant, 'menus' => $menus]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(),
       [
        'restaurant_title' => ['required', 'min:3', 'max:64', 'alpha'],
        'restaurant_customers' => ['required', 'min:1', 'numeric'],
        'restaurant_employees' => ['required', 'min:1', 'numeric'],
       ],

       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
       
       $restaurant = new Restaurant;
       $restaurant->title = $request->restaurant_title;
       $restaurant->customers = $request->restaurant_customers;
       $restaurant->employees = $request->restaurant_employees;
       $restaurant->menu_id = $request->menu_id;
       $restaurant->save();
       return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
         return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai ištrintas.');


    }

    public function pdf(Restaurant $restaurant)
    {
        $pdf = PDF::loadView('restaurant.pdf', ['restaurant' => $restaurant]);
        return $pdf->download($restaurant ->name.'.pdf');
    }

}