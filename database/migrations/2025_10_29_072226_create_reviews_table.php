<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('author');                 // Tên người đánh giá
            $table->string('avatar')->nullable();     // Đường dẫn avatar
            $table->boolean('verified')->default(false); // Đã mua hàng
            $table->unsignedTinyInteger('rating')->default(5); // Số sao (1-5)
            $table->string('variant')->nullable();    // Loại sản phẩm (VD: Labubu)
            $table->date('date')->nullable();         // Ngày đánh giá
            $table->string('title')->nullable();      // Tiêu đề
            $table->text('content')->nullable();      // Nội dung đánh giá
            $table->json('media')->nullable();        // Danh sách ảnh/video JSON
            $table->string('type')->nullable();       // Loại đánh giá video or image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
