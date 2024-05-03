<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNonce extends Migration
{
    public function up(): void
    {
        Schema::table('twill_sec_head', function (Blueprint $table) {
            $table->renameColumn('csp_generate_nounce', 'csp_generate_nonce');
        });
    }

    public function down(): void
    {
        $table->renameColumn('csp_generate_nonce', 'csp_generate_nounce');
    }
}
