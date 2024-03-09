<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateExperienceRequest;
use App\Models\UserExperience;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

#[ObservedBy([UserObserver::class])]

class UserExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $experiences = Cache::rememberForever("exps:" . $user->id,function() use($user){
           return $user->experiences;
        });
        
        $experiences = UserExperience::where('user_id',auth()->user()->id)->paginate(5);

        // return response()->json(['exps' => $experiences]);

        return view('experience.list',['exps' => $experiences]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdateExperienceRequest $request)
    {
        $exp= new UserExperience();
        $exp->user_id = auth()->user()->id;
        $exp->title = $request->title;
        $exp->description = $request->description;
        $exp->save();
        
        return redirect()->route('experiences');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exp=UserExperience::where('id',$id)->where('user_id',auth()->user()->id)->firstOrFail();
        $exp->delete();
        return redirect()->route('experiences');
    }
}
