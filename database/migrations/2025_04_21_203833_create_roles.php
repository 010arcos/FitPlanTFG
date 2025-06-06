<?php

use Illuminate\Database\Migrations\Migration;
Use Spatie\Permission\Models\Permission;
Use Spatie\Permission\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
