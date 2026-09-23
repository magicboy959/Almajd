<?php
namespace App\Http\Controllers;
use App\Models\RequestDocument;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class DocumentController extends Controller {
 public function store(Request $request,ServiceRequest $serviceRequest){abort_unless($request->user()->customer?->id===$serviceRequest->customer_id || $request->user()->can('documents.create'),403); $data=$request->validate(['document'=>'required|file|mimes:pdf,jpg,jpeg,png|max:10240','service_requirement_id'=>'nullable|exists:service_requirements,id']); $file=$data['document']; $stored=Str::uuid().'.'.$file->extension(); $path=$file->storeAs('requests/'.$serviceRequest->id,$stored,'local'); $doc=$serviceRequest->documents()->create(['service_requirement_id'=>$data['service_requirement_id']??null,'uploaded_by'=>$request->user()->id,'original_name'=>$file->getClientOriginalName(),'stored_name'=>$stored,'path'=>$path,'mime_type'=>$file->getMimeType(),'size'=>$file->getSize(),'status'=>'pending_scan']); return response()->json($doc,201);}
 public function download(Request $request,RequestDocument $document){abort_unless($request->user()->customer?->id===$document->request->customer_id || $request->user()->can('documents.view'),403); abort_unless(Storage::disk($document->disk)->exists($document->path),404); \App\Models\AuditLog::create(['user_id'=>$request->user()->id,'action'=>'document.download','auditable_type'=>RequestDocument::class,'auditable_id'=>$document->id,'ip_address'=>$request->ip()]); return Storage::disk($document->disk)->download($document->path,$document->original_name,['Content-Type'=>$document->mime_type]);}
}
