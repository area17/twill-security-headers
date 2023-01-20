<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwillSecurityHeadersTables extends Migration
{
    public function up(): void
    {
        Schema::create('twill_sec_head', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->boolean('hsts_enabled')->default(true);
            $table->text('hsts')->nullable();

            $table->boolean('csp_enabled')->default(true);
            $table->text('csp_block')->nullable();
            $table->text('csp_report_only')->nullable();
            $table->string('csp_security')->default('block');

            $table->boolean('expect_ct_enabled')->default(false);
            $table->text('expect_ct')->nullable();

            $table->boolean('xss_protection_policy_enabled')->default(false);
            $table->text('xss_protection_policy')->nullable();

            $table->boolean('x_frame_policy_enabled')->default(true);
            $table->text('x_frame_policy')->nullable();

            $table->boolean('x_content_type_policy_enabled')->default(true);
            $table->text('x_content_type_policy')->nullable();

            $table->boolean('referrer_policy_enabled')->default(true);
            $table->text('referrer_policy')->nullable();

            $table->boolean('permissions_policy_enabled')->default(true);
            $table->text('permissions_policy')->nullable();

            $table->text('unwanted_headers')->nullable();
        });

        Schema::create('twill_sec_head_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'twill_sec_head', 'twill_sec_head');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('twill_sec_head_revisions');
        Schema::dropIfExists('twill_sec_head');
    }
}
