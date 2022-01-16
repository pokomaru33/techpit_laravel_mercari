<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyPage\BoughtItemsController;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PdfController extends Controller
{
    //
    public function index($item_id){
        $user = Auth::user();
        $date = new Carbon();

        $pdf = PDF::loadView('pdf.recipt', compact('user', 'date'));
        return $pdf->download('領収書.pdf');
    }

    public function view(){
        $user = Auth::user();
        $items = $user->boughtItems()->orderBy('id', 'DESC')->get();
        $total_price = 0;
        foreach($items as $item){
            $total_price += $item->price;
        }
        number_format($total_price);
        $date = new Carbon();

        return view('pdf.recipt', compact('user','items','total_price', 'date'));
        // return dd($date);
    }
}
