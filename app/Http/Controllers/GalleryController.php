<?php

namespace App\Http\Controllers;
 
use App\Models\GalleryGroup;
use Illuminate\Http\Request;
 
class GalleryController extends Controller
{
    public function index($locale)
    {
        $groups = GalleryGroup::with('photos')
            ->orderByDesc('date')
            ->get();
 
        $years = $groups->map(fn($g) => $g->date->format('Y'))
            ->unique()
            ->sortDesc()
            ->values();
 
        return view('gallery', compact('groups', 'years'));
    }
}