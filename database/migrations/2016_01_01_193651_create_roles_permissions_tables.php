<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');


            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('permissions');
    }
    /*
    
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'category.index', NULL, NULL), (NULL, 'category.create', NULL, NULL),(NULL, 'category.edit', NULL, NULL),(NULL, 'category.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'brand.index', NULL, NULL), (NULL, 'brand.create', NULL, NULL),(NULL, 'brand.edit', NULL, NULL),(NULL, 'brand.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'attribute-set.index', NULL, NULL), (NULL, 'attribute-set.create', NULL, NULL),(NULL, 'attribute-set.edit', NULL, NULL),(NULL, 'attribute-set.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'badge.index', NULL, NULL), (NULL, 'badge.create', NULL, NULL),(NULL, 'badge.edit', NULL, NULL),(NULL, 'badge.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'coupon.index', NULL, NULL), (NULL, 'coupon.create', NULL, NULL),(NULL, 'coupon.edit', NULL, NULL),(NULL, 'coupon.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'currency.index', NULL, NULL), (NULL, 'currency.create', NULL, NULL),(NULL, 'currency.edit', NULL, NULL),(NULL, 'currency.destroy', NULL, NULL);


INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'flash-sale.index', NULL, NULL), (NULL, 'flash-sale.create', NULL, NULL),(NULL, 'flash-sale.edit', NULL, NULL),(NULL, 'flash-sale.destroy', NULL, NULL);


INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'page.index', NULL, NULL), (NULL, 'page.create', NULL, NULL),(NULL, 'page.edit', NULL, NULL),(NULL, 'page.destroy', NULL, NULL);


INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'report.index', NULL, NULL);


INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'setting.edit', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'slide.index', NULL, NULL), (NULL, 'slide.create', NULL, NULL),(NULL, 'slide.edit', NULL, NULL),(NULL, 'slide.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'tag.index', NULL, NULL), (NULL, 'tag.create', NULL, NULL),(NULL, 'tag.edit', NULL, NULL),(NULL, 'tag.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'translation.index', NULL, NULL), (NULL, 'translation.create', NULL, NULL),(NULL, 'translation.edit', NULL, NULL),(NULL, 'translation.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'user.index', NULL, NULL), (NULL, 'user.create', NULL, NULL),(NULL, 'user.edit', NULL, NULL),(NULL, 'user.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'blog.index', NULL, NULL), (NULL, 'blog.create', NULL, NULL),(NULL, 'blog.edit', NULL, NULL),(NULL, 'blog.destroy', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'attribute.index', NULL, NULL), (NULL, 'attribute.create', NULL, NULL),(NULL, 'attribute.edit', NULL, NULL),(NULL, 'attribute.destroy', NULL, NULL);
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'sub-category.index', NULL, NULL), (NULL, 'sub-category.create', NULL, NULL),(NULL, 'sub-category.edit', NULL, NULL),(NULL, 'sub-category.destroy', NULL, NULL);
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'child-category.index', NULL, NULL), (NULL, 'child-category.create', NULL, NULL),(NULL, 'child-category.edit', NULL, NULL),(NULL, 'child-category.destroy', NULL, NULL);
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'category.update', NULL, NULL),(NULL, 'sub-category.update', NULL, NULL),(NULL, 'child-category.update', NULL, NULL),(NULL, 'brand.update', NULL, NULL),(NULL, 'attribute.update', NULL, NULL),(NULL, 'badge.update', NULL, NULL),
(NULL, 'coupon.update', NULL, NULL),(NULL, 'currency.update', NULL, NULL),(NULL, 'flash-sale.update', NULL, NULL),
(NULL, 'page.update', NULL, NULL),(NULL, 'setting.update', NULL, NULL),(NULL, 'slide.update', NULL, NULL),(NULL, 'tag.update', NULL, NULL),
(NULL, 'translation.update', NULL, NULL),(NULL, 'user.update', NULL, NULL),(NULL, 'blog.update', NULL, NULL),(NULL, 'attribute-set.update', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'category.store', NULL, NULL),(NULL, 'sub-category.store', NULL, NULL),(NULL, 'child-category.store', NULL, NULL),(NULL, 'brand.store', NULL, NULL),(NULL, 'attribute.store', NULL, NULL),(NULL, 'badge.store', NULL, NULL),
(NULL, 'coupon.store', NULL, NULL),(NULL, 'currency.store', NULL, NULL),(NULL, 'flash-sale.store', NULL, NULL),
(NULL, 'page.store', NULL, NULL),(NULL, 'slide.store', NULL, NULL),(NULL, 'tag.store', NULL, NULL),
(NULL, 'translation.store', NULL, NULL),(NULL, 'user.store', NULL, NULL),(NULL, 'blog.store', NULL, NULL),(NULL, 'attribute-set.store', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES(NULL, 'role.index', NULL, NULL), (NULL, 'role.create', NULL, NULL),(NULL, 'role.edit', NULL, NULL),(NULL, 'role.destroy', NULL, NULL),(NULL, 'role.store', NULL, NULL),(NULL, 'role.update', NULL, NULL);
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'product.index', NULL, NULL),
 (NULL, 'product.create', NULL, NULL),
 (NULL, 'product.edit', NULL, NULL),
 (NULL, 'product.destroy', NULL, NULL),
 (NULL, 'product.store', NULL, NULL),
 (NULL, 'product.update', NULL, NULL);

 INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'order.index', NULL, NULL),
 (NULL, 'order.show', NULL, NULL),
 (NULL, 'order.edit', NULL, NULL),
 (NULL, 'order.destroy', NULL, NULL),
 (NULL, 'order.update', NULL, NULL);

 INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'faq.index', NULL, NULL),
 (NULL, 'faq.create', NULL, NULL),
 (NULL, 'faq.edit', NULL, NULL),
 (NULL, 'faq.destroy', NULL, NULL),
 (NULL, 'faq.store', NULL, NULL),
 (NULL, 'faq.update', NULL, NULL);

  INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'ticket-category.index', NULL, NULL),
 (NULL, 'ticket-category.create', NULL, NULL),
 (NULL, 'ticket-category.edit', NULL, NULL),
 (NULL, 'ticket-category.destroy', NULL, NULL),
 (NULL, 'ticket-category.store', NULL, NULL),
 (NULL, 'ticket-category.update', NULL, NULL);


  INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'ticket.index', NULL, NULL),
 (NULL, 'ticket.create', NULL, NULL),
 (NULL, 'ticket.edit', NULL, NULL),
 (NULL, 'ticket.destroy', NULL, NULL),
 (NULL, 'ticket.store', NULL, NULL),
 (NULL, 'ticket.update', NULL, NULL);

  INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'affiliate.index', NULL, NULL),
 (NULL, 'affiliate.create', NULL, NULL),
 (NULL, 'affiliate.edit', NULL, NULL),
 (NULL, 'affiliate.destroy', NULL, NULL),
 (NULL, 'affiliate.store', NULL, NULL),
 (NULL, 'affiliate.update', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'language.index', NULL, NULL),
(NULL, 'language.show', NULL, NULL),
 (NULL, 'language.create', NULL, NULL),
 (NULL, 'language.edit', NULL, NULL),
 (NULL, 'language.destroy', NULL, NULL),
 (NULL, 'language.store', NULL, NULL),
 (NULL, 'language.update', NULL, NULL);

 INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'shipping-method.index', NULL, NULL),
(NULL, 'shipping-method.show', NULL, NULL),
 (NULL, 'shipping-method.create', NULL, NULL),
 (NULL, 'shipping-method.edit', NULL, NULL),
 (NULL, 'shipping-method.destroy', NULL, NULL),
 (NULL, 'shipping-method.store', NULL, NULL),
 (NULL, 'shipping-method.update', NULL, NULL);

  INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'review.index', NULL, NULL),
(NULL, 'review.show', NULL, NULL),
 (NULL, 'review.create', NULL, NULL),
 (NULL, 'review.edit', NULL, NULL),
 (NULL, 'review.destroy', NULL, NULL),
 (NULL, 'review.store', NULL, NULL),
 (NULL, 'review.update', NULL, NULL);

   INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'customer.index', NULL, NULL),
 (NULL, 'customer.update', NULL, NULL);
 INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(NULL, 'withdraw.index', NULL, NULL),
 (NULL, 'withdraw.update', NULL, NULL),
  (NULL, 'customer.destroy', NULL, NULL),
 (NULL, 'withdraw.destroy', NULL, NULL);

*/
}
