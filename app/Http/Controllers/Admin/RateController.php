<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function store(RateRequest $request)
    {
        $rating = Rate::create([
            'rateable_type' => Product::class,
            'rateable_id'=> $request->get('id'),
            'rating' => $request->get('rating'),
        ]);
        return $rating ;
    }
}
