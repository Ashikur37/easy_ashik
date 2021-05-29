<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Model{
/**
 * App\Model\AffiliateProduct
 *
 * @property int $id
 * @property int $product_id
 * @property string $percentage
 * @property int $status
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AffiliateProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Attribute
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $attribute_set_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\AttributeSet $attributeSet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ChildCategory[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\AttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Attribute extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\AttributeSet
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AttributeSet extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\AttributeValue
 *
 * @property int $id
 * @property string $value
 * @property int $attribute_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttributeValue[] $productAttributeValues
 * @property-read int|null $product_attribute_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValue($value)
 * @mixin \Eloquent
 */
	class AttributeValue extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Badge
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $background
 * @property int $status
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Badge extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\BadgeProduct
 *
 * @property int $product_id
 * @property int $badge_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Badge $badge
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereBadgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class BadgeProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Banner
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Banner extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Blog
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $details
 * @property string $image
 * @property int $show
 * @property string $meta_title
 * @property string $meta_description
 * @property int $click
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereClick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Blog extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\BlogComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Blog $blog
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $repliers
 * @property-read int|null $repliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogCommentReply[] $replies
 * @property-read int|null $replies_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUserId($value)
 * @mixin \Eloquent
 */
	class BlogComment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\BlogCommentReply
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_comment_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\BlogComment $blogComment
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereBlogCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereUserId($value)
 * @mixin \Eloquent
 */
	class BlogCommentReply extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\BlogTag
 *
 * @property int $blog_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Tag $tag
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class BlogTag extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Brand
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string|null $banner
 * @property int $status
 * @property string $slug
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Brand extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Category
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $slug
 * @property string|null $banner
 * @property int $status
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $product_view
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $trendingProducts
 * @property-read int|null $trending_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ChildCategory[] $childCategories
 * @property-read int|null $child_categories_count
 */
	class Category extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ChildCategory
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $banner
 * @property int $status
 * @property string $slug
 * @property int $sub_category_id
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Model\SubCategory $subCategory
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ChildCategory extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Color
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Color extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Coupon
 *
 * @property int $id
 * @property string $code
 * @property int $is_percent
 * @property int $active
 * @property int $all_product
 * @property int $amount
 * @property int $limit
 * @property float|null $min
 * @property float|null $max
 * @property int $times
 * @property int $used
 * @property string|null $start
 * @property string|null $end
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\CouponProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAllProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUsed($value)
 * @mixin \Eloquent
 */
	class Coupon extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\CouponOrder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CouponOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponOrder query()
 * @mixin \Eloquent
 */
	class CouponOrder extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\CouponProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $coupon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CouponProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $sign
 * @property float $rate
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Currency extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\EmailSetting
 *
 * @property int $id
 * @property string $smtp_host
 * @property string $smtp_port
 * @property string $smtp_user
 * @property string $smtp_pass
 * @property string $from_email
 * @property string $from_name
 * @property int $is_active
 * @property string $mail_encryption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereFromEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereMailEncryption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereUpdatedAt($value)
 */
	class EmailSetting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Faq
 *
 * @property int $id
 * @property string $title
 * @property string $details
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Faq extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\FeatureCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FeatureCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeatureCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeatureCategory query()
 * @mixin \Eloquent
 */
	class FeatureCategory extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\File
 *
 * @property int $id
 * @property string $filename
 * @property string $path
 * @property string $extension
 * @property string $mime
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class File extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\FlashSale
 *
 * @property int $id
 * @property string|null $title
 * @property string $image
 * @property int $is_active
 * @property string $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $flashProducts
 * @property-read int|null $flash_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\FlashSaleProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class FlashSale extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\FlashSaleProduct
 *
 * @property int $id
 * @property int $flash_sale_id
 * @property int $product_id
 * @property string $price
 * @property int $qty
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereFlashSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereQty($value)
 * @mixin \Eloquent
 */
	class FlashSaleProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\FlashSaleProductOrder
 *
 * @property int $flash_sale_product_id
 * @property int $order_id
 * @property int $qty
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder whereFlashSaleProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProductOrder whereQty($value)
 * @mixin \Eloquent
 */
	class FlashSaleProductOrder extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Language
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property int $is_default
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Language extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\NewsLetter
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class NewsLetter extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\NotificationSetting
 *
 * @property int $id
 * @property int $admin_db_new_user
 * @property int $admin_db_new_order
 * @property int $admin_db_product_comment
 * @property int $admin_db_product_review
 * @property int $admin_db_product_comment_reply
 * @property int $admin_db_blog_comment_reply
 * @property int $admin_db_new_ticket
 * @property int $admin_db_ticket_reply
 * @property int $admin_db_withdraw
 * @property int $admin_db_blog_comment
 * @property int $admin_db_contact_form
 * @property int $admin_mail_new_user
 * @property int $admin_mail_new_order
 * @property int $admin_mail_product_comment
 * @property int $admin_mail_product_review
 * @property int $admin_mail_product_comment_reply
 * @property int $admin_mail_blog_comment_reply
 * @property int $admin_mail_new_ticket
 * @property int $admin_mail_ticket_reply
 * @property int $admin_mail_withdraw
 * @property int $admin_mail_blog_comment
 * @property int $admin_mail_contact_form
 * @property int $user_db_product_comment_reply
 * @property int $user_db_blog_comment_reply
 * @property int $user_db_ticket_reply
 * @property int $user_db_order_success
 * @property int $user_db_order_update
 * @property int $user_db_withdraw_update
 * @property int $user_db_balance_update
 * @property int $user_mail_product_comment_reply
 * @property int $user_mail_blog_comment_reply
 * @property int $user_mail_ticket_reply
 * @property int $user_mail_order_success
 * @property int $user_mail_order_update
 * @property int $user_mail_withdraw_update
 * @property int $user_mail_balance_update
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbBlogComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbBlogCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbContactForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbNewOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbNewTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbNewUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbProductComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbProductCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbProductReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbTicketReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminDbWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailBlogComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailBlogCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailContactForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailNewOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailNewTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailNewUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailProductComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailProductCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailProductReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailTicketReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereAdminMailWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbBalanceUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbBlogCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbOrderSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbOrderUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbProductCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbTicketReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserDbWithdrawUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailBalanceUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailBlogCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailOrderSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailOrderUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailProductCommentReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailTicketReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserMailWithdrawUpdate($value)
 */
	class NotificationSetting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Option
 *
 * @property int $id
 * @property string $name
 * @property int $required
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OptionValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Option extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OptionValue
 *
 * @property int $id
 * @property int $option_id
 * @property string|null $price
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class OptionValue extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Order
 *
 * @property int $id
 * @property string $order_number
 * @property int|null $customer_id
 * @property string $customer_email
 * @property string|null $customer_phone
 * @property string $customer_first_name
 * @property string $customer_last_name
 * @property string $billing_first_name
 * @property string $billing_last_name
 * @property string $billing_address_1
 * @property string|null $billing_address_2
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip
 * @property string $billing_country
 * @property string $shipping_first_name
 * @property string $shipping_last_name
 * @property string $shipping_address_1
 * @property string|null $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_state
 * @property string $shipping_zip
 * @property string $shipping_country
 * @property string $sub_total
 * @property string $shipping_method
 * @property string $shipping_cost
 * @property int|null $coupon_id
 * @property string $discount
 * @property string $total
 * @property float $tax
 * @property string $payment_method
 * @property string $currency
 * @property string $currency_rate
 * @property string $locale
 * @property string $status
 * @property int $payment_status
 * @property string|null $note
 * @property string $cart
 * @property int $affiliator
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderAddtional[] $additionals
 * @property-read int|null $additionals_count
 * @property-read \App\Model\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderTrack[] $tracks
 * @property-read int|null $tracks_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAffiliator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $transaction_id
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OrderAddtional
 *
 * @property int $id
 * @property int $order_id
 * @property int $payment_gateway_additional_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\PaymentGatewayAdditional $paymentGatewayAdditional
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional wherePaymentGatewayAdditionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereValue($value)
 * @mixin \Eloquent
 */
	class OrderAddtional extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $unit_price
 * @property int $qty
 * @property string $line_total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereLineTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Product $product
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OrderProductOption
 *
 * @property int $id
 * @property int $order_product_id
 * @property int $option_id
 * @property string|null $value
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereOrderProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereValue($value)
 * @mixin \Eloquent
 */
	class OrderProductOption extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OrderProductOptionValue
 *
 * @property int $order_product_option_id
 * @property int $option_value_id
 * @property string|null $price
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue whereOptionValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue whereOrderProductOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOptionValue wherePrice($value)
 * @mixin \Eloquent
 */
	class OrderProductOptionValue extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\OrderTrack
 *
 * @property int $id
 * @property int $order_id
 * @property string $title
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class OrderTrack extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Page
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $body
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Page extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\PageSetting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PageSetting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\PaymentGateway
 *
 * @property int $id
 * @property string $title
 * @property string $details
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PaymentGatewayAdditional[] $additionals
 * @property-read int|null $additionals_count
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentGateway extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\PaymentGatewayAdditional
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $title
 * @property string|null $details
 * @property int $required
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentGatewayAdditional extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\PaymentSetting
 *
 * @property int $id
 * @property int $is_paypal
 * @property int $is_stripe
 * @property int $is_cod
 * @property int $is_razor_pay
 * @property string $paypal_mode
 * @property string $paypal_client
 * @property string $paypal_secret
 * @property string $stripe_key
 * @property string $stripe_secret
 * @property string $razorpay_key
 * @property string $razorpay_secret
 * @property float $tax
 * @property int $is_ssl
 * @property string $store_id
 * @property string $store_password
 * @property string $ssl_mode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereIsCod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereIsPaypal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereIsRazorPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereIsSsl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereIsStripe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereRazorpayKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereRazorpaySecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereSslMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStorePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStripeKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStripeSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereUpdatedAt($value)
 */
	class PaymentSetting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Permission
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Permission extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int|null $sub_category_id
 * @property int|null $child_category_id
 * @property string $details
 * @property int|null $brand_id
 * @property string $slug
 * @property string $image
 * @property string $price
 * @property string $price_type
 * @property string|null $special_price
 * @property string|null $special_price_start
 * @property string|null $special_price_end
 * @property string $special_price_type
 * @property string|null $selling_price
 * @property string|null $sku
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int $manage_stock
 * @property int|null $qty
 * @property int $in_stock
 * @property int $viewed
 * @property int $is_active
 * @property int $is_trending
 * @property int $is_hot
 * @property int $is_top
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttributeValue[] $attributeValues
 * @property-read int|null $attribute_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BadgeProduct[] $badges
 * @property-read int|null $badges_count
 * @property-read \App\Model\Brand|null $brand
 * @property-read \App\Model\Category $category
 * @property-read \App\Model\ChildCategory|null $childCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductColor[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductComment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $rating
 * @property-read mixed $rating_percent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Badge[] $productBadges
 * @property-read int|null $product_badges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Color[] $productColors
 * @property-read int|null $product_colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Size[] $productSizes
 * @property-read int|null $product_sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tag[] $productTags
 * @property-read int|null $product_tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductSize[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \App\Model\SubCategory|null $subCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductTag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBrandId($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereChildCategoryId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDetails($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereInStock($value)
 * @method static Builder|Product whereIsActive($value)
 * @method static Builder|Product whereIsHot($value)
 * @method static Builder|Product whereIsTop($value)
 * @method static Builder|Product whereIsTrending($value)
 * @method static Builder|Product whereManageStock($value)
 * @method static Builder|Product whereMetaDescription($value)
 * @method static Builder|Product whereMetaTitle($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePriceType($value)
 * @method static Builder|Product whereQty($value)
 * @method static Builder|Product whereSellingPrice($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereSpecialPrice($value)
 * @method static Builder|Product whereSpecialPriceEnd($value)
 * @method static Builder|Product whereSpecialPriceStart($value)
 * @method static Builder|Product whereSpecialPriceType($value)
 * @method static Builder|Product whereSubCategoryId($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereViewed($value)
 * @mixin \Eloquent
 * @property int $best_deal
 * @property int|null $user_id
 * @property-read mixed $sold
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBestDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property-read \App\Model\Attribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereProductId($value)
 * @mixin \Eloquent
 */
	class ProductAttribute extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductAttributeValue
 *
 * @property int $product_attribute_id
 * @property int $attribute_value_id
 * @property-read \App\Model\AttributeValue $value
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereAttributeValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereProductAttributeId($value)
 * @mixin \Eloquent
 */
	class ProductAttributeValue extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductClick
 *
 * @property int $id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductClick whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProductClick extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductColor
 *
 * @property int $product_id
 * @property int $color_id
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereProductId($value)
 * @mixin \Eloquent
 */
	class ProductColor extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $repliers
 * @property-read int|null $repliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductCommentReply[] $replies
 * @property-read int|null $replies_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereUserId($value)
 * @mixin \Eloquent
 */
	class ProductComment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductCommentReply
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_comment_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\ProductComment $productComment
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereProductCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereUserId($value)
 * @mixin \Eloquent
 */
	class ProductCommentReply extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductImage
 *
 * @property int $product_id
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @mixin \Eloquent
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductOption
 *
 * @property int $product_id
 * @property int $option_id
 * @property-read \App\Model\Option $option
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereProductId($value)
 * @mixin \Eloquent
 */
	class ProductOption extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductSize
 *
 * @property int $product_id
 * @property int $size_id
 * @property float $price
 * @property-read \App\Model\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereSizeId($value)
 * @mixin \Eloquent
 */
	class ProductSize extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ProductTag
 *
 * @property int $product_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProductTag extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\RelatedProduct
 *
 * @property int $product_id
 * @property int $related_product_id
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct whereRelatedProductId($value)
 * @mixin \Eloquent
 */
	class RelatedProduct extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Review
 *
 * @property int $id
 * @property int|null $reviewer_id
 * @property int $product_id
 * @property int $rating
 * @property string $comment
 * @property string $title
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Review extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Setting
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $supported_countries
 * @property string|null $theme_color
 * @property string|null $default_country
 * @property string|null $contact
 * @property string|null $mail
 * @property string|null $address
 * @property string|null $copyright_text
 * @property string|null $default_locale
 * @property string|null $default_timezone
 * @property int|null $is_newsletter
 * @property int $is_cookie
 * @property int|null $guest_checkout
 * @property int|null $email_verification
 * @property int|null $is_captcha
 * @property int|null $auto_approval_review
 * @property string|null $favicon
 * @property string|null $header_logo
 * @property string|null $footer_logo
 * @property string|null $mail_logo
 * @property string|null $invoice_logo
 * @property string|null $admin_logo
 * @property string|null $site_loader
 * @property string|null $admin_loader
 * @property string|null $facebook_link
 * @property string|null $youtube_link
 * @property string|null $instagram_link
 * @property string|null $skype_link
 * @property string|null $pinterest_link
 * @property int|null $is_maintenance
 * @property string|null $maintenance_text
 * @property string|null $service1_title
 * @property string|null $service1_image
 * @property string|null $service2_title
 * @property string|null $service2_image
 * @property string|null $service3_title
 * @property string|null $service3_image
 * @property string|null $service4_title
 * @property string|null $service4_image
 * @property string|null $banner_404
 * @property string|null $news_letter_title
 * @property string|null $news_letter_sub_title
 * @property string|null $cookie_message
 * @property string|null $cookie_button
 * @property string|null $custom_css
 * @property string|null $custom_js
 * @property int|null $is_messenger
 * @property string|null $messenger
 * @property int|null $is_tawk_to
 * @property string|null $tawk_to
 * @property int|null $is_pixel
 * @property string|null $facebook_pixel
 * @property int|null $is_analytic
 * @property string|null $google_analytic
 * @property int|null $is_top_right_banner_1
 * @property int|null $is_top_right_banner_2
 * @property string|null $top_right_banner_1_image
 * @property string|null $top_right_banner_2_image
 * @property string|null $top_right_banner_1_text
 * @property string|null $top_right_banner_1_url
 * @property int|null $top_right_banner_1_new_window
 * @property string|null $top_right_banner_2_text
 * @property string|null $top_right_banner_2_url
 * @property int|null $top_right_banner_2_new_window
 * @property int $is_two_column_banner_1
 * @property int $is_two_column_banner_2
 * @property string $two_column_banner_1_image
 * @property string $two_column_banner_2_image
 * @property string $two_column_banner_1_url
 * @property int $two_column_banner_1_new_window
 * @property string $two_column_banner_2_url
 * @property int $two_column_banner_2_new_window
 * @property int|null $is_best_deal_banner_1
 * @property int|null $is_best_deal_banner_2
 * @property string|null $best_deal_banner_1_image
 * @property string|null $best_deal_banner_2_image
 * @property string|null $best_deal_banner_1_url
 * @property int|null $best_deal_banner_1_new_window
 * @property string|null $best_deal_banner_2_url
 * @property int|null $best_deal_banner_2_new_window
 * @property string|null $is_full_width_banner
 * @property string|null $full_width_banner_image
 * @property string|null $full_width_banner_url
 * @property string|null $full_width_banner_new_window
 * @property string $full_width_banner_2_image
 * @property string $full_width_banner_2_url
 * @property int $full_width_banner_2_new_window
 * @property string|null $is_slider
 * @property int|null $is_brands
 * @property int|null $is_flash_deal
 * @property int|null $is_blog
 * @property string|null $is_best_sale
 * @property int|null $is_service
 * @property int|null $top_in_category
 * @property int|null $is_three_column_product
 * @property string|null $address2
 * @property string|null $mail1
 * @property string|null $mail2
 * @property string|null $phone1
 * @property string|null $phone2
 * @property int|null $is_map
 * @property string|null $lat
 * @property string|null $lon
 * @property string|null $about_title
 * @property string $term_title
 * @property string $term_description
 * @property string|null $about_description
 * @property int $affiliate_withdraw
 * @property int $affiliate_shopping
 * @property float $global_affiliate_percent
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $news_letter_image
 * @property int $is_new_arrival
 * @property int $is_best_deal
 * @property string $two_column_banner_3_image
 * @property string $two_column_banner_3_url
 * @property int $two_column_banner_3_new_window
 * @property string $service1_sub_title
 * @property string $service2_sub_title
 * @property string $service3_sub_title
 * @property string $service4_sub_title
 * @property string $payment_image
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAboutDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAboutTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAdminLoader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAdminLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAffiliateShopping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAffiliateWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAutoApprovalReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBanner404($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner1Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner1NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner1Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner2Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner2NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBestDealBanner2Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCookieButton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCookieMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCopyrightText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCustomJs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDefaultCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDefaultLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDefaultTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereEmailVerification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFacebookPixel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFooterLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBanner2Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBanner2NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBanner2Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBannerImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBannerNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullWidthBannerUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGlobalAffiliatePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGoogleAnalytic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGuestCheckout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHeaderLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInstagramLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInvoiceLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsAnalytic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBestDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBestDealBanner1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBestDealBanner2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBestSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBlog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsBrands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsCaptcha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsFlashDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsFullWidthBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsMaintenance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsMessenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsNewArrival($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsPixel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsSlider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTawkTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsThreeColumnProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTopRightBanner1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTopRightBanner2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTwoColumnBanner1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTwoColumnBanner2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMail1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMail2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaintenanceText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMessenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereNewsLetterImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereNewsLetterSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereNewsLetterTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePaymentImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePinterestLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService1Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService1SubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService1Title($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService2Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService2SubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService2Title($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService3Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService3SubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService3Title($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService4Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService4SubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereService4Title($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSiteLoader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSkypeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSupportedCountries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTawkTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTermDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTermTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopInCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner1Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner1NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner1Text($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner1Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner2Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner2NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner2Text($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTopRightBanner2Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner1Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner1NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner1Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner2Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner2NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner2Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner3Image($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner3NewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwoColumnBanner3Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereYoutubeLink($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ShippingMethod
 *
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property int $is_active
 * @property float|null $free_min
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereFreeMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ShippingMethod extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\SiteVisit
 *
 * @property int $id
 * @property string $ip
 * @property int $is_new
 * @property string $url
 * @property string $visit_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereVisitDate($value)
 * @mixin \Eloquent
 */
	class SiteVisit extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Size
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size query()
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Size extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Slide
 *
 * @property int $id
 * @property string $image
 * @property string|null $title
 * @property string|null $body
 * @property string|null $call_to_action_url
 * @property int|null $open_in_new_window
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $color
 * @property int $direction
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCallToActionUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereOpenInNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $button_text
 * @property string $title_color
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereTitleColor($value)
 */
	class Slide extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\SocialLoginSetting
 *
 * @property int $id
 * @property int $is_facebook
 * @property int $is_google
 * @property string $facebook_client_id
 * @property string $facebook_client_secret
 * @property string $google_client_id
 * @property string $google_client_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereFacebookClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereFacebookClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereGoogleClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereGoogleClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereIsFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereIsGoogle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLoginSetting whereUpdatedAt($value)
 */
	class SocialLoginSetting extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $banner
 * @property int $status
 * @property string $slug
 * @property int $category_id
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ChildCategory[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SubCategory extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Subscriber
 *
 * @property int $id
 * @property string $email
 * @property string $ip
 * @property int $mail_count
 * @property string $last_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereLastEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereMailCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereUpdatedAt($value)
 */
	class Subscriber extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Blog[] $blogs
 * @property-read int|null $blogs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $blog_count
 */
	class Tag extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Theme
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Theme extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Throttle
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle query()
 * @mixin \Eloquent
 */
	class Throttle extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Ticket
 *
 * @property int $id
 * @property int $ticket_category_id
 * @property string $subject
 * @property int $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TicketMessage[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Model\TicketCategory $ticketCategory
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @mixin \Eloquent
 */
	class Ticket extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\TicketCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TicketCategory extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\TicketMessage
 *
 * @property int $id
 * @property int $ticket_id
 * @property string $message
 * @property string|null $attachment
 * @property int $sender_id
 * @property int $sender_type
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Ticket $ticket
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSenderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TicketMessage extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Transaction
 *
 * @property int $id
 * @property int $order_id
 * @property string $transaction_id
 * @property string $payment_method
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Transaction extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Translation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @mixin \Eloquent
 */
	class Translation extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\UserRole
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @mixin \Eloquent
 */
	class UserRole extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\UserTrackOrder
 *
 * @property int $id
 * @property string $order_number
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereUserId($value)
 * @mixin \Eloquent
 */
	class UserTrackOrder extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Vendor
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $address
 * @property string $product_type
 * @property string|null $nid_trade
 * @property string|null $dealing_system
 * @property string|null $mobile_banking_no
 * @property string|null $mobile_bank_type
 * @property string|null $bank_account_no
 * @property string|null $bank_name
 * @property string|null $branch
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereBankAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDealingSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMobileBankType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMobileBankingNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereNidTrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUserId($value)
 */
	class Vendor extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\WishList
 *
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WishList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList query()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereUserId($value)
 * @mixin \Eloquent
 */
	class WishList extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Withdraw
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property int $status
 * @property string|null $account_name
 * @property string|null $email
 * @property string|null $method
 * @property string|null $iban
 * @property string|null $address
 * @property string|null $swift
 * @property string|null $reference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereSwift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserId($value)
 * @mixin \Eloquent
 */
	class Withdraw extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Word
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Word newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Word newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Word query()
 * @mixin \Eloquent
 */
	class Word extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\key
 *
 * @property int $id
 * @property string $term
 * @property int $hits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|key newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|key newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|key query()
 * @method static \Illuminate\Database\Eloquent\Builder|key whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class key extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $lastname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $avatar
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $access_token
 * @property int $type
 * @property string $affiliate_link
 * @property float $affiliate_balance
 * @property string|null $remember_token
 * @property int $is_vendor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $wishListProducts
 * @property-read int|null $wish_list_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVendor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\VendorOrder
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property float $quantity
 * @property float $price
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorOrder whereUserId($value)
 */
	class VendorOrder extends \Eloquent {}
}

