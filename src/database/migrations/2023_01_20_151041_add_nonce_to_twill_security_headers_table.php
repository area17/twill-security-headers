<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNonceToTwillSecurityHeadersTable extends Migration
{
    public function up(): void
    {
        Schema::table('twill_sec_head', function (Blueprint $table) {
            $table->boolean('csp_generate_nounce')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropColumns('twill_sec_head', 'csp_generate_nounce');
    }
}
