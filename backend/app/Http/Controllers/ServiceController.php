<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
class ServiceController extends Controller { public function index(Request $request){$locale=$request->get('locale','en'); $query=Service::query()->with('category')->where('published',true)->when($request->search,fn($q,$v)=>$q->where(fn($q)=>$q->where('name_en','like',"%$v%")->orWhere('name_ar','like',"%$v%")))->when($request->category,fn($q,$v)=>$q->whereHas('category',fn($q)=>$q->where('slug',$v))); return response()->json(['data'=>$query->paginate(12),'categories'=>ServiceCategory::where('published',true)->orderBy('sort_order')->get()]); } public function show(string $slug){return Service::with(['category','requirements','faqs'])->where('slug',$slug)->where('published',true)->firstOrFail();} }
