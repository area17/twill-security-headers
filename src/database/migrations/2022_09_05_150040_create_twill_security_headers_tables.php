<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwillSecurityHeadersTables extends Migration
{
    public function up(): void
    {
        Schema::create('twill_security_headers', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->boolean('hsts_enabled')->default(true);
            $table->json('hsts')->nullable();

            $table->boolean('csp_enabled')->default(true);
            $table->json('csp')->nullable();

            $table->boolean('expect_ct_enabled')->default(true);
            $table->json('expect_ct')->nullable();

            $table->boolean('xss_protection_enabled')->default(true);
            $table->json('xss_protection')->nullable();

            $table->boolean('x_frame_policy_enabled')->default(true);
            $table->json('x_frame_policy')->nullable();

            $table->boolean('x_content_type_policy_enabled')->default(true);
            $table->json('x_content_type_policy')->nullable();

            $table->boolean('referrer_policy_enabled')->default(true);
            $table->json('referrer_policy')->nullable();

            $table->boolean('permissions_policy_enabled')->default(true);
            $table->json('permissions_policy')->nullable();

            $table->json('unwanted_headers')->default('["X-Powered-By", "server", "Server"]');
        });

        Schema::create('twill_security_headers_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'twill_security_headers', 'twill_security_headers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('twill_security_headers_revisions');
        Schema::dropIfExists('twill_security_headers');
    }
}
