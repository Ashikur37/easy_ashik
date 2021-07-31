<?php $__env->startSection('title', "$lng->Dashboard"); ?>
<?php $__env->startSection('content'); ?>
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper">
        <h4 class="section-title"><?php echo e($lng->AccountInfo); ?></h4>
        <div class="account-infos">
            <div class="row">
                <div class="col-md-6 right-border">
                    <div class="info">
                        <span class="label"><?php echo e($lng->Name); ?></span>
                        <span class="value"><?php echo e(auth()->user()->name); ?></span>
                    </div>
                    <div class="info">
                        <span class="label"><?php echo e($lng->Mail); ?></span>
                        <span class="value"><?php echo e(auth()->user()->email); ?></span>
                    </div>
                    <div class="info">
                        <span class="label"><?php echo e($lng->Joined); ?></span>
                        <span class="value"><?php echo e(auth()->user()->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
                <div class="col-md-6 pl-md-25">
                    <div class="info">
                        <span class="label"><?php echo e($lng->TotalOrder); ?></span>
                        <span class="value"><?php echo e(auth()->user()->orders->count()); ?></span>
                    </div>
                    <div class="info">
                        <span class="label"><?php echo e($lng->Balance); ?></span>
                        <span class="value">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance)); ?></span>
                    </div>
                    <div class="info">
                        <span class="label"><?php echo e($lng->Spent); ?></span>
                        <span class="value">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->spent())); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chart-wrapper">
        <div class="row my-3">
            <div class="col-md-6 col-12">
                <div class="order-status-chart">
                    <div class="legend-wrapper">
                        <span><?php echo e($lng->OrderStatus); ?></span>
                        <div class="legend-info">
                            <span class="legend-bg delivered"></span>
                            <span class="legend-text"><?php echo e($lng->Completed); ?></span>
                            <span class="legend-value"><?php echo e(auth()->user()->orders->where('status',3)->count()); ?></span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg pending"></span>
                            <span class="legend-text"><?php echo e($lng->Pending); ?></span>
                            <span class="legend-value"><?php echo e(auth()->user()->orders->where('status',0)->count()); ?></span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg canceled"></span>
                            <span class="legend-text"><?php echo e($lng->Other); ?></span>
                            <span class="legend-value"><?php echo e(auth()->user()->orders->whereNotIn('status',[0,3])->count()); ?></span>
                        </div>
                    </div>
                    <svg id="pie-chart" width="200" height="150">
                        <text x="53%" y="50%" class="text" text-anchor="middle">
                            <tspan dx="0" dy="0"><?php echo e($lng->Total); ?></tspan>
                            <tspan dx="52%" x="0" dy="1.6em"><?php echo e(auth()->user()->orders->count()); ?></tspan>
                        </text>
                    </svg>
                </div>
            </div>
            <div class="col-md-6 col-12 affiliate-chart-wrapper">
                <div class="affiliate-info-chart">
                    <div class="legend-wrapper">
                        <span><?php echo e($lng->Affiliation); ?> <?php echo e($lng->Status); ?></span>
                        <div class="legend-info">
                            <span class="legend-bg earned"></span>
                            <span class="legend-text"><?php echo e($lng->Earned); ?></span>
                            <span class="legend-value">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->withdrawAmount()+auth()->user()->spent()+auth()->user()->affiliate_balance)); ?></span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg balance"></span>
                            <span class="legend-text"><?php echo e($lng->Balance); ?></span>
                            <span class="legend-value">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance)); ?></span>
                        </div>
                        <div class="legend-info">
                            <span class="legend-bg spent"></span>
                            <span class="legend-text"><?php echo e($lng->Withdraw); ?></span>
                            <span class="legend-value">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->withdrawAmount())); ?></span>
                        </div>
                    </div>
                    <svg id="pie-chart2" width="200" height="150">
                        <text x="53%" y="50%" class="text" text-anchor="middle">
                            <tspan dx="0" dy="0"><?php echo e($lng->Spent); ?></tspan>
                            <tspan dx="52%" x="0" dy="1.6em">৳ <?php echo e(App\Model\Product::currencyPriceRate(auth()->user()->spent())); ?></tspan>
                        </text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-wrapper recent-order-container mb-0">
        <h4 class="section-title bb-none"><?php echo e($lng->MyOrder); ?></h4>
        <table class="table">
            <thead>
                <tr class="title-row">
                    <th scope="col"><?php echo e($lng->OrderId); ?></th>
                    <th scope="col"><?php echo e($lng->Date); ?></th>
                    <th scope="col"><?php echo e($lng->Total); ?></th>
                    <th scope="col"><?php echo e($lng->Status); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-row" data-href="<?php echo e(route('user.order.show', $order->order_number)); ?>">
                    <td><?php echo e($order->order_number); ?></td>
                    <td><?php echo e($order->created_at->format('Md,Y')); ?></td>
                    <td>৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></td>
                    <td><span class="status-badge <?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody> 
        </table>
        <div class="md-card-wrapper">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="md-card table-row" data-href="<?php echo e(route('user.order.show', $order->order_number)); ?>">
                <div class="md-card-row">
                    <span><?php echo e($lng->OrderId); ?></span>
                    <span><?php echo e($order->order_number); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Date); ?></span>
                    <span><?php echo e($order->created_at->format('Md,Y')); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Total); ?></span>
                    <span>৳<?php echo e(App\Model\Product::currencyPriceRate($order->total)); ?></span>
                </div>
                <div class="md-card-row">
                    <span><?php echo e($lng->Status); ?></span>
                    <span><span class="status-badge <?php echo e($order->statusClass()); ?>"><?php echo e($order->statusText()); ?></span></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script>
    var data = [{
        "name": "<?php echo e($lng->Completed); ?>",
        "color": "#00C1FF",
        "value": <?php echo e(auth()->user()->orders->where('status', 3)->count()); ?>

    }, {
        "name": "<?php echo e($lng->Pending); ?>",
        "color": "#8E98BF",
        "value": <?php echo e(auth()->user()->orders->where('status', 0)->count()); ?>

    }, {
        "name": "<?php echo e($lng->Other); ?>",
        "color": "#FF2660",
        "value": <?php echo e(auth()->user()->orders->whereNotIn('status', [0, 3])->count()); ?>

    }];
    var svg = document.getElementById('pie-chart'),
        totalValue = 0,
        radius = 55,
        circleLength = Math.PI * (radius * 2),
        spaceLeft = circleLength;
    for (var i = 0; i < data.length; i++) {
        totalValue += data[i].value;
    }
    for (var c = 0; c < data.length; c++) {
        var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("class", "pie-chart-value");
        circle.setAttribute("cx", 100);
        circle.setAttribute("cy", 75);
        circle.setAttribute("r", radius);
        circle.style.strokeDasharray = (spaceLeft) + " " + circleLength;
        circle.style.stroke = data[c].color;
        svg.appendChild(circle);
        spaceLeft -= (data[c].value / totalValue) * circleLength;
    }
</script>

<script>
    var data = [{
            "name": "<?php echo e($lng->Earned); ?>",
            "color": "#275EF6",
            "value": <?php echo e(auth()->user()->withdrawAmount()+auth()->user()->spent()+auth()->user()->affiliate_balance); ?>

        },
        {
            "name": "<?php echo e($lng->Balance); ?>",
            "color": "#AA35E3",
            "value": <?php echo e(auth()->user()->affiliate_balance); ?>

        }, {
            "name": "<?php echo e($lng->Withdraw); ?>",
            "color": "#FF2660",
            "value": <?php echo e(auth()->user()->withdrawAmount()); ?>

        }
    ];
    var svg = document.getElementById('pie-chart2'),
        list = document.getElementById('pie-values2'),
        totalValue = 0,
        radius = 55,
        circleLength = Math.PI * (radius * 2), // Circumference = PI * Diameter
        spaceLeft = circleLength;
    for (var i = 0; i < data.length; i++) {
        totalValue += data[i].value;
    }
    for (var c = 0; c < data.length; c++) {
        var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("class", "pie-chart-value");
        circle.setAttribute("cx", 100);
        circle.setAttribute("cy", 75);
        circle.setAttribute("r", radius);
        circle.style.strokeDasharray = (spaceLeft) + " " + circleLength;
        circle.style.stroke = data[c].color;
        svg.appendChild(circle);
        spaceLeft -= (data[c].value / totalValue) * circleLength;
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/user/home/index.blade.php ENDPATH**/ ?>