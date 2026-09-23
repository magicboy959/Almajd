<?php
namespace App\Console\Commands;
use App\Models\RequestDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
class PurgeDocuments extends Command { protected $signature='documents:purge'; protected $description='Remove expired private documents'; public function handle(): int { RequestDocument::whereNotNull('expires_at')->where('expires_at','<',now())->each(function($document){Storage::disk($document->disk)->delete($document->path); $document->delete();}); return self::SUCCESS; } }
