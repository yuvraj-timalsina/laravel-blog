<?php
    
    use App\Models\User;
    use App\Models\Category;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    return new class extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->string('featured_image');
                $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
                $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
                $table->softDeletes();
                $table->timestamps();
            });
        }
        
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('posts');
        }
    };