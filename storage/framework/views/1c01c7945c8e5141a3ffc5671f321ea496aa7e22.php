<?php $__env->startSection('title', "$lng->AdminDashboard"); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin')); ?>/css/page/dashboard.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-20 dashboard-element-wrapper mt-80">
        <div class="row prl-5">
            <div class="col-xl-3 col-sm-6 col-12 prl-10" id="total-sale">
                <div class="p-4 dashboard-element">
                    <h5><?php echo e($lng->TotalSales); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="total-sale" class="drop-day dropdown-item"><?php echo e($lng->Today); ?></a>
                            <a data-val="7" data-id="total-sale" class="drop-day dropdown-item"><?php echo e($lng->_7Days); ?></a>
                            <a data-val="15" data-id="total-sale" class="drop-day dropdown-item"><?php echo e($lng->_15Days); ?></a>
                            <a data-val="30" data-id="total-sale" class="drop-day dropdown-item"><?php echo e($lng->_30Days); ?></a>
                        </div>
                    </div>
                    <span class="small-text" id="total-sale-day"><?php echo e($lng->_30Days); ?></span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="total-sale-count"><?php echo e($totalSale); ?></h4>
                        <span class="flex-item"> <span class="small-text"
                                id="total-sale-growth"><?php echo e(abs(round($totalSaleGrowth, 2)) > 100000 ? abs(round($totalSaleGrowth / 1000)) . 'k' : abs(round($totalSaleGrowth, 2))); ?>%</span><i
                                id="total-sale-class"
                                class=' <?php echo e($totalSaleGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill'); ?>'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-sm-0">
                <div class="p-4 dashboard-element">
                    <h5> <?php echo e($lng->TotalOrder); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="sale-count" class="drop-day dropdown-item"><?php echo e($lng->Today); ?></a>
                            <a data-val="7" data-id="sale-count" class="drop-day dropdown-item"><?php echo e($lng->_7Days); ?></a>
                            <a data-val="15" data-id="sale-count" class="drop-day dropdown-item"><?php echo e($lng->_15Days); ?></a>
                            <a data-val="30" data-id="sale-count" class="drop-day dropdown-item"><?php echo e($lng->_30Days); ?></a>
                        </div>
                    </div>
                    <span class="small-text" id="sale-count-day"><?php echo e($lng->_30Days); ?></span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="sale-count-count"><?php echo e($totalSaleCount); ?></h4>
                        <span class="flex-item"> <span class="small-text"
                                id="sale-count-growth"><?php echo e(abs(round($totalSaleCountGrowth, 2))); ?>%</span><i
                                id="sale-count-class"
                                class=' <?php echo e($totalSaleCountGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill'); ?>'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5><?php echo e($lng->TotalCustomers); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="total-customer" class="drop-day dropdown-item"><?php echo e($lng->Today); ?></a>
                            <a data-val="7" data-id="total-customer" class="drop-day dropdown-item"><?php echo e($lng->_7Days); ?></a>
                            <a data-val="15" data-id="total-customer" class="drop-day dropdown-item"><?php echo e($lng->_15Days); ?></a>
                            <a data-val="30" data-id="total-customer" class="drop-day dropdown-item"><?php echo e($lng->_30Days); ?></a>
                        </div>
                    </div>
                    <span class="small-text" id="total-customer-day"><?php echo e($lng->_30Days); ?></span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="total-customer-count"><?php echo e($totalCustomerCount); ?></h4>
                        <span class="flex-item"> <span id="total-customer-growth"
                                class="small-text"><?php echo e(abs(round($totalCustomerGrowth, 2))); ?>%</span><i
                                id="total-customer-class"
                                class=' <?php echo e($totalCustomerGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill'); ?>'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5><?php echo e($lng->TotalProducts); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="product-sale" class="drop-day dropdown-item"><?php echo e($lng->Today); ?></a>
                            <a data-val="7" data-id="product-sale" class="drop-day dropdown-item"><?php echo e($lng->_7Days); ?></a>
                            <a data-val="15" data-id="product-sale" class="drop-day dropdown-item"><?php echo e($lng->_15Days); ?></a>
                            <a data-val="30" data-id="product-sale" class="drop-day dropdown-item"><?php echo e($lng->_30Days); ?></a>
                        </div>
                    </div>
                    <span class="small-text" id="product-sale-day"><?php echo e($lng->_30Days); ?></span>
                    <div class="mt-4  flex-item">
                        <h4 class="mb-0" id="product-sale-count"><?php echo e($productSoldCount); ?></h4>
                        <span class="flex-item"> <span class="small-text"
                                id="product-sale-growth"><?php echo e(abs(round($productSoldGrowth, 2))); ?>%</span><i
                                class=' <?php echo e($productSoldGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill'); ?>'
                                id="product-sale-class"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-20 prl-5">
            <div class="col-xl-4 col-md-6 col-12 prl-10 d-flex align-items-stretch ">
                <div class="p-2 dashboard-element">
                    <div class="p-3">
                        <h5><?php echo e($lng->Visitors); ?></h5>
                    </div>
                    <div id="visitors"></div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12 mt-20 mt-md-0 prl-10 d-flex align-items-stretch">
                <div class="p-4 dashboard-element">
                    <h5><?php echo e($lng->Orderstatistics); ?></h5>
                    <div id="orderStatistics"></div>
                    <div class="ts-legend row">
                        <div class="col-sm-6 col-12 pr-6">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics processing"></span>
                                    <?php echo e($lng->Processing); ?>

                                </span>
                                <h5><?php echo e($processingCount); ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 pl-6 mt-2 mt-sm-0">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics completed"></span>
                                    <?php echo e($lng->Completed); ?>

                                </span>
                                <h5><?php echo e($completedCount); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="ts-legend row mt-2 mt-sm-3">
                        <div class="col-sm-6 col-12 pr-6">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics panding"></span>
                                    <?php echo e($lng->Pending); ?>

                                </span>
                                <h5><?php echo e($pendingCount); ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 pl-6 mt-2 mt-sm-0">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics canceled"></span>
                                    <?php echo e($lng->Canceled); ?>

                                </span>
                                <h5><?php echo e($cancelCount); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-12 prl-10 d-flex align-items-stretch mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5><?php echo e($lng->OrderSuccessRate); ?></h5>
                    <div id="orderSuccess"></div>
                    <div class="ts-legend row">
                        <div class="col-12">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-success other"></span> <?php echo e($lng->Other); ?>

                                </span>
                                <h5>
                                    <?php if(($completedCount + $otherCount)>0): ?>
                                    <?php echo e(round(($otherCount * 100) / ($completedCount + $otherCount))); ?>%
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-success completed"></span> <?php echo e($lng->Completed); ?>

                                </span>
                                <h5>
                                    <?php if(($completedCount + $otherCount)>0): ?>
                                    <?php echo e(round(($completedCount * 100) / ($completedCount + $otherCount))); ?>%
                                    <?php else: ?>
                                    0%
                                    <?php endif; ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch mt-20 order-5 order-xl-4">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->RecentOrders); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="<?php echo e(route('order.index')); ?>" class="dropdown-item"><?php echo e($lng->SeeAll); ?></a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo e($lng->Id); ?></th>
                                    <th><?php echo e($lng->Customer); ?></th>
                                    <th><?php echo e($lng->Status); ?></th>
                                    <th><?php echo e($lng->Total); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="dashboard-table-row" data-href="<?php echo e(route('order.show', $order->id)); ?>">
                                        <td>
                                            <span><?php echo e($order->order_number); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($order->customer_first_name); ?> <?php echo e($order->customer_last_name); ?></span>
                                        </td>
                                        <td>
                                            <span class="text-<?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span>
                                        </td>
                                        <td>
                                            <span>৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12 prl-10 d-flex align-items-stretch mt-20 order-4 order-xl-5">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->RecentActivity); ?></h5>
                    <?php $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="recent-activity-wrapper dashboard-table-row"
                            data-href="<?php echo e($notification->data['link']); ?>">
                            <div class="py-3 px-sm-2 content-wrapper">
                                <div class="d-flex justify-content-between">
                                    <div class="recent-activity-content">
                                        <img src="<?php echo e(asset('icons/' . $notification->data['icon'])); ?>" alt="Notification">
                                        <div>
                                            <h5 class="mb-0"><?php echo e($notification->data['title']); ?></h5>
                                            <p class="mb-0"><?php echo Str::limit($notification->data['text'], 150); ?></p>
                                        </div>
                                    </div>
                                    <div class="recent-activity-timer">
                                        <span
                                            class="time"><?php echo e($notification->created_at->diffForHumans(null, true, true)); ?></span>
                                        <span
                                            class="notification-status <?php echo e($notification->read_at ? 'seen' : 'unseen'); ?>"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="row mt-20 prl-5">
            <div class="col-md-6 col-12 prl-10">
                <div class="p-2 dashboard-element">
                    <div class="p-3">
                        <h5><?php echo e($lng->Ordervariant); ?></h5>
                    </div>
                    <div id="growthChart"></div>
                </div>
            </div>
            <div class="col-md-6 col-12 prl-10 mt-20 mt-md-0">
                <div class="p-2 dashboard-element">
                    <div class="p-3">
                        <h5><?php echo e($lng->SalesHistory); ?></h5>
                    </div>
                    <div id="salesHistoryChart"></div>
                </div>
            </div>
        </div>
        <div class="row mt-20 prl-5">
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->Ticket); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="<?php echo e(route('ticket.index')); ?>" class="dropdown-item"><?php echo e($lng->SeeAll); ?></a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="shortest-th"><?php echo e($lng->User); ?></th>
                                    <th></th>
                                    <th><?php echo e($lng->Subject); ?></th>
                                    <th><?php echo e($lng->Type); ?></th>
                                    <th><?php echo e($lng->Message); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="dashboard-table-row" data-href="<?php echo e(route('ticket.index')); ?>">
                                        <td>
                                            <div class="text-left user">
                                                <div class="user-img">
                                                    <span class="status-unread"></span>
                                                    <img src="<?php echo e($ticket->user->getImageUrl()); ?>" alt="User">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <span><?php echo e($ticket->user->name); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($ticket->subject); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($ticket->ticketCategory->name); ?></span>
                                        </td>
                                        <td><span class="message"><?php echo e($ticket->messages->last()->message); ?> </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch mt-20 mt-xl-0">
                <div class="px-4 pt-4 pb-3 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->TopProducts); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="<?php echo e(route('product.index')); ?>" class="dropdown-item"><?php echo e($lng->SeeAll); ?></a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="shortest-th pr-0"><?php echo e($lng->Product); ?></th>
                                    <th></th>
                                    <th><?php echo e($lng->Sold); ?></th>
                                    <th><?php echo e($lng->Viewed); ?></th>
                                    <th><?php echo e($lng->Price); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="dashboard-table-row"
                                        data-href="<?php echo e(route('front-product.show', $product->slug)); ?>">
                                        <td>
                                            <div class="text-left product">
                                                <div class="product-img">
                                                    <img src="<?php echo e(asset('images/product/' . $product->image)); ?>" alt="Product">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <div class="product-details">
                                                <p class="mb-0"><?php echo e(Str::limit($product->name, 30, '...')); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <span><?php echo e($product->orders->sum('qty')); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($product->viewed); ?></span>
                                        </td>
                                        <td><span
                                                class="price">৳<?php echo e(App\Model\Product::currencyPriceRate($product->price)); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-20 prl-5">
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->LatestReviews); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="<?php echo e(route('review.index')); ?>" class="dropdown-item"><?php echo e($lng->SeeAll); ?></a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="shortest-th pr-0"><?php echo e($lng->Product); ?></th>
                                    <th></th>
                                    <th class="medius-th"><?php echo e($lng->User); ?></th>
                                    <th class="short-th"><?php echo e($lng->Rating); ?></th>
                                    <th><?php echo e($lng->Comment); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="dashboard-table-row" data-href="<?php echo e(route('review.index')); ?>">
                                        <td>
                                            <div class="text-left product">
                                                <div class="product-img">
                                                    <img src="<?php echo e(asset('images/product/' . $review->product->image)); ?>"
                                                        alt="Product">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <div class="product-details">
                                                <p class="mb-0"><?php echo e($review->product->name); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <span><?php echo e($review->user->name); ?></span>
                                        </td>
                                        <td>
                                            <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:<?php echo e($review->rating * 20); ?>%"></div>
                                            </div>
                                        </td>
                                        <td><span class="comment"><?php echo e(Str::limit($review->comment, 40)); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4"><?php echo e($lng->LatestComments); ?></h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="<?php echo e(route('comment.index')); ?>" class="dropdown-item"><?php echo e($lng->SeeAll); ?></a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="shortest-th pr-0"><?php echo e($lng->Product); ?></th>
                                    <th></th>
                                    <th class="medius-th"><?php echo e($lng->User); ?></th>
                                    <th class="short-th"><?php echo e($lng->Time); ?></th>
                                    <th><?php echo e($lng->Comment); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="dashboard-table-row"
                                        data-href="<?php echo e(route('front-product.show', $comment->product->slug)); ?>">
                                        <td>
                                            <div class="text-left product">
                                                <div class="product-img">
                                                    <img src="<?php echo e(asset('images/product/' . $comment->product->image)); ?>"
                                                        alt="Product">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <div class="product-details">
                                                <p class="mb-0"><?php echo e(Str::limit($comment->product->name, 40)); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <span><?php echo e($comment->user->name); ?> <?php echo e($comment->user->lastname); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                        </td>
                                        <td><span class="comment"><?php echo e(Str::limit($comment->text, 40)); ?> </span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- chart js -->
    <script src="<?php echo e(asset('assets/admin')); ?>/js/vendor/apexcharts.min.js"></script>
    <script src="<?php echo e(asset('assets/admin')); ?>/js/page/dashboard.js"></script>
    <script>
      
  //start visitor 
  var options = {
    chart: {
      width: "100%",
      height: 280,
      type: "area",
      toolbar: {
        show: false
      },
    },   
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
    },
    toolbar: {
      show: false
    },
    legend: {
      show: false,
    },
    colors: ['#0080ff', '#00CDA2'],
    series: [{
      name: 'Total View',
      data: <?php echo json_encode($visitors); ?>

  }, 
    {
      name: 'Visitors',
      data: <?php echo json_encode($unique_visitors); ?>

    }
  ],
  grid: {
    row: {
        colors: ['transparent', 'transparent'], opacity: .2
    },
    borderColor: 'rgba(0,0,0,0.05)'
  }, 
  xaxis: {
      categories: <?php echo json_encode($days); ?>,
      axisBorder: {
        show: true, 
        color: 'rgba(0,0,0,0.05)'
    },
  },
  };
  
  var chart = new ApexCharts(document.querySelector("#visitors"), options);
  chart.render();
  // end visitor 
  // start Order statistics 
  var options = {
    chart: {
      type: "donut",
      width: '215',
    },
    colors: ["#0062FF","#00CDA2", "#858CA7", "#FF1E77"],
    series: [<?php echo e($processingCount); ?>, <?php echo e($completedCount); ?>, <?php echo e($pendingCount); ?>, <?php echo e($cancelCount); ?>],
    labels: ['Processing', 'Completed', 'Pending','Canceled'],
  
    dataLabels: {
       enabled: false
    },
    plotOptions: {
      pie: {
        donut: {
          size: '75%',
          labels: {
            show: true,
            name: {
            show: false,
          },
          value: {
            show: true,
            fontSize: '22px',
            fontFamily: 'Roboto',
            color: undefined,
            offsetY: 10,
            formatter: function (val) {
              return val
            }
          },
            total: {
            show: true,
            label: 'Total',
            color: '#0B2430',
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                return a + b
              }, 0)
            }
          }
          }
        }
      }
    },
    tooltip: {
      enabled: true,
      color:"#fff",
      y: {
        formatter: function(val) {
          return val
        },
        title: {
          formatter: function (seriesName) {
            return seriesName
          }
        }
      }
    },
    legend: {
      show: false
    }
  };
  var chart = new ApexCharts(document.querySelector("#orderStatistics"), options);
  chart.render();
// end Order statistics 
// start Order Success Rate   
var options = {   
    chart: {
      width: '250',  
      type: 'radialBar',   
  },
  labels: ['Other', 'Completed'],
  <?php if(($completedCount+$otherCount)>0): ?>
  series: [<?php echo e(round($completedCount*100/($completedCount+$otherCount))); ?>, <?php echo e(round($otherCount*100/($completedCount+$otherCount))); ?>],
  <?php else: ?>
  series:[0,0],
  <?php endif; ?>
  colors:['#57B8FF','#0062FF'],
  plotOptions: {
    radialBar: {
      size: '75%',     
      dataLabels: {
        show: true,
        name: {
          show: false,
        },
        value: {
          show: true,
            fontSize: '22px',
            fontFamily: 'Roboto',
            color: undefined,
            offsetY: 10,
            formatter: function (val) {
              return val+"%"
            }
        },
        total: {
            show: true,
            label: 'Total',
            color: '#0B2430',
            formatter: function (w) {
              <?php if(($completedCount+$otherCount)>0): ?>
              return "<?php echo e(round($completedCount*100/($completedCount+$otherCount))); ?>%";
              <?php else: ?>
              return "0%";
              <?php endif; ?>
            }
          }
      }
    }
  },
  legend: {
    show: false
}
};
  
  var chart = new ApexCharts(document.querySelector("#orderSuccess"), options);
  chart.render();
  // end Order Success Rate 

  // start Customar growth
  var options = {
    chart: {
        height: 270,
        type: 'bar',
        stacked: true,
        toolbar: {
            show: false
        },
        zoom: {
            enabled: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '20%',
        },
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#0062FF','#57B8FF','#D5D7E3'],
    series: [{
        name: 'Direct',
        data: <?php echo json_encode($organicOrders); ?>

    },{
        name: 'Coupon',
        data: <?php echo json_encode($couponOrders); ?>

    },{
      name: 'Affiliate',
      data: <?php echo json_encode($affiliateOrders); ?>

  }],         
    xaxis: {   
        categories: <?php echo json_encode($months); ?>,
        axisBorder: {
            show: true, 
            color: 'rgba(0,0,0,0.05)'
        },
        axisTicks: {
            show: true, 
            color: 'rgba(0,0,0,0.05)'
        }
    },
    grid: {
        row: {
            colors: ['transparent', 'transparent'], opacity: .2
        },
        borderColor: 'rgba(0,0,0,0.05)'
    },
    legend: {
        show: false
    },
    fill: {
        opacity: 1
    },
  }

  
  var chart = new ApexCharts(
    document.querySelector("#growthChart"),
    options
  );        
  chart.render();
  // end Customar growth
  // start Sales History
  var options = { 
    chart: {
    type: 'bar',
    height: 270,
    toolbar: {
      show: false
  }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '48%',
    },
  },
  colors:['#0062FF','#D5D7E3'],
  series: [{
    name: 'Order',
    data: <?php echo json_encode($monthOrders); ?>

  }, {
    name: 'Sale in thousand',
    data: <?php echo json_encode($monthSales); ?>

  }],
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: <?php echo json_encode($months); ?>,
    axisBorder: {
      show: true, 
      color: 'rgba(0,0,0,0.05)'
  },
  },
  grid: {
    row: {
        colors: ['transparent', 'transparent'], opacity: .2
    },
    borderColor: 'rgba(0,0,0,0.05)'
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return  val ;
      }
    }
  },
  legend: {
    show: false
    }
  };
  var chart = new ApexCharts(document.querySelector("#salesHistoryChart"), options);
  chart.render();
  // end Sales History
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',['headerText' => $lng->Dashboard], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/admin/home/index.blade.php ENDPATH**/ ?>