<?php

use App\Constants\LeaveStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('referred_by')->constrained('users');
            $table->foreignId('leave_policy_id')->constrained('leavepolicies');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('days')->nullable();
            $table->longText('leave_reason');
            $table->string('status')->default(LeaveStatus::PENDING);
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
