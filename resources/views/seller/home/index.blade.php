@extends('layouts.vendor',['headerText' => $lng->Dashboard])
@section('title', "$lng->Dashboard")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/dashboard.css">
@endsection
@section('content')
    <div class="mb-20 dashboard-element-wrapper mt-80">
        {{-- <div class="row prl-5">
            <div class="col-xl-3 col-sm-6 col-12 prl-10" id="total-sale">
                <div class="p-4 dashboard-element">
                    <h5>{{ $lng->TotalSales }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="total-sale" class="drop-day dropdown-item">{{ $lng->Today }}</a>
                            <a data-val="7" data-id="total-sale" class="drop-day dropdown-item">{{ $lng->_7Days }}</a>
                            <a data-val="15" data-id="total-sale" class="drop-day dropdown-item">{{ $lng->_15Days }}</a>
                            <a data-val="30" data-id="total-sale" class="drop-day dropdown-item">{{ $lng->_30Days }}</a>
                        </div>
                    </div>
                    <span class="small-text" id="total-sale-day">{{ $lng->_30Days }}</span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="total-sale-count">{{ $totalSale }}</h4>
                        <span class="flex-item"> <span class="small-text"
                                id="total-sale-growth">{{ abs(round($totalSaleGrowth, 2)) > 100000 ? abs(round($totalSaleGrowth / 1000)) . 'k' : abs(round($totalSaleGrowth, 2)) }}%</span><i
                                id="total-sale-class"
                                class=' {{ $totalSaleGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill' }}'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-sm-0">
                <div class="p-4 dashboard-element">
                    <h5> {{ $lng->TotalOrder }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="sale-count" class="drop-day dropdown-item">{{ $lng->Today }}</a>
                            <a data-val="7" data-id="sale-count" class="drop-day dropdown-item">{{ $lng->_7Days }}</a>
                            <a data-val="15" data-id="sale-count" class="drop-day dropdown-item">{{ $lng->_15Days }}</a>
                            <a data-val="30" data-id="sale-count" class="drop-day dropdown-item">{{ $lng->_30Days }}</a>
                        </div>
                    </div>
                    <span class="small-text" id="sale-count-day">{{ $lng->_30Days }}</span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="sale-count-count">{{ $totalSaleCount }}</h4>
                        <span class="flex-item"> <span class="small-text"
                                id="sale-count-growth">{{ abs(round($totalSaleCountGrowth, 2)) }}%</span><i
                                id="sale-count-class"
                                class=' {{ $totalSaleCountGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill' }}'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5>{{ $lng->TotalCustomers }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="total-customer" class="drop-day dropdown-item">{{ $lng->Today }}</a>
                            <a data-val="7" data-id="total-customer" class="drop-day dropdown-item">{{ $lng->_7Days }}</a>
                            <a data-val="15" data-id="total-customer" class="drop-day dropdown-item">{{ $lng->_15Days }}</a>
                            <a data-val="30" data-id="total-customer" class="drop-day dropdown-item">{{ $lng->_30Days }}</a>
                        </div>
                    </div>
                    <span class="small-text" id="total-customer-day">{{ $lng->_30Days }}</span>
                    <div class="mt-4 flex-item">
                        <h4 class="mb-0" id="total-customer-count">{{ $totalCustomerCount }}</h4>
                        <span class="flex-item"> <span id="total-customer-growth"
                                class="small-text">{{ abs(round($totalCustomerGrowth, 2)) }}%</span><i
                                id="total-customer-class"
                                class=' {{ $totalCustomerGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill' }}'></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 prl-10 mt-20 mt-xl-0">
                <div class="p-4 dashboard-element">
                    <h5>{{ $lng->TotalProducts }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a data-val="0" data-id="product-sale" class="drop-day dropdown-item">{{ $lng->Today }}</a>
                            <a data-val="7" data-id="product-sale" class="drop-day dropdown-item">{{ $lng->_7Days }}</a>
                            <a data-val="15" data-id="product-sale" class="drop-day dropdown-item">{{ $lng->_15Days }}</a>
                            <a data-val="30" data-id="product-sale" class="drop-day dropdown-item">{{ $lng->_30Days }}</a>
                        </div>
                    </div>
                    <span class="small-text" id="product-sale-day">{{ $lng->_30Days }}</span>
                    <div class="mt-4  flex-item">
                        <h4 class="mb-0" id="product-sale-count">{{ $productSoldCount }}</h4>
                        <span class="flex-item"> <span class="small-text"
                                id="product-sale-growth">{{ abs(round($productSoldGrowth, 2)) }}%</span><i
                                class=' {{ $productSoldGrowth < 0 ? 'down-arrow ri-arrow-down-fill' : 'up-arrow ri-arrow-up-fill' }}'
                                id="product-sale-class"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-20 prl-5">
            
            <div class=" col-md-6 col-12 mt-md-0 prl-10 d-flex align-items-stretch">
                <div class="p-4 dashboard-element">
                    <h5>{{ $lng->Orderstatistics }}</h5>
                    <div id="orderStatistics"></div>
                    <div class="ts-legend row">
                        <div class="col-sm-6 col-12 pr-6">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics processing"></span>
                                    {{ $lng->Processing }}
                                </span>
                                <h5>{{ $processingCount }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 pl-6 mt-2 mt-sm-0">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics completed"></span>
                                    {{ $lng->Completed }}
                                </span>
                                <h5>{{ $completedCount }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="ts-legend row mt-2 mt-sm-3">
                        <div class="col-sm-6 col-12 pr-6">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics panding"></span>
                                    {{ $lng->Pending }}
                                </span>
                                <h5>{{ $pendingCount }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 pl-6 mt-2 mt-sm-0">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-statistics canceled"></span>
                                    {{ $lng->Canceled }}
                                </span>
                                <h5>{{ $cancelCount }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 prl-10 d-flex align-items-stretch mt-xl-0 sm-mt-20">
                <div class="p-4 dashboard-element">
                    <h5>{{ $lng->OrderSuccessRate }}</h5>
                    <div id="orderSuccess"></div>
                    <div class="ts-legend row">
                        <div class="col-12">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-success other"></span> {{ $lng->Other }}
                                </span>
                                <h5>
                                    @if(($completedCount + $otherCount)>0)
                                    {{ round(($otherCount * 100) / ($completedCount + $otherCount)) }}%
                                    @else
                                        0%
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="flex-item item-count">
                                <span class="small-text">
                                    <span class="order-success completed"></span> {{ $lng->Completed }}
                                </span>
                                <h5>
                                    @if(($completedCount + $otherCount)>0)
                                    {{ round(($completedCount * 100) / ($completedCount + $otherCount)) }}%
                                    @else
                                    0%
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="row mt-20 prl-5">
            <div class="col-md-6 col-12 prl-10">
                <div class="p-2 dashboard-element">
                    <div class="p-3">
                        <h5>{{ $lng->Ordervariant }}</h5>
                    </div>
                    <div id="growthChart"></div>
                </div>
            </div>
            <div class="col-md-6 col-12 prl-10 mt-20 mt-md-0">
                <div class="p-2 dashboard-element">
                    <div class="p-3">
                        <h5>{{ $lng->SalesHistory }}</h5>
                    </div>
                    <div id="salesHistoryChart"></div>
                </div>
            </div>
        </div> --}}
        <div class="row mt-20 prl-5">
            
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch mt-xl-0">
                <div class="px-4 pt-4 pb-3 dashboard-element">
                    <h5 class="mb-4">{{ $lng->TopProducts }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="{{ route('product.index') }}" class="dropdown-item">{{ $lng->SeeAll }}</a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="shortest-th pr-0">{{ $lng->Product }}</th>
                                    <th></th>
                                    <th>{{ $lng->Sold }}</th>
                                    <th>{{ $lng->Viewed }}</th>
                                    <th>{{ $lng->Price }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProducts as $product)
                                    <tr class="dashboard-table-row"
                                        data-href="{{ route('front-product.show', $product->slug) }}">
                                        <td>
                                            <div class="text-left product">
                                                <div class="product-img">
                                                    <img src="{{ asset('images/product/' . $product->image) }}" alt="Product">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <div class="product-details">
                                                <p class="mb-0">{{ Str::limit($product->name, 30, '...') }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ $product->orders->sum('qty') }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $product->viewed }}</span>
                                        </td>
                                        <td><span
                                                class="price">{{ App\Model\Product::currencyPriceRate($product->price) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12 prl-10 d-flex align-items-stretch xl-mt-20 order-5 order-xl-4">
                <div class="p-4 dashboard-element">
                    <h5 class="mb-4">{{ $lng->RecentOrders }}</h5>
                    <div class="filter-option">
                        <span data-toggle="dropdown" class="filter-option-trigger"><i class="ri-more-2-fill"></i></span>
                        <div class="dropdown-menu dropdown-menu-right filter-option-menu">
                            <a href="{{ route('order.index') }}" class="dropdown-item">{{ $lng->SeeAll }}</a>
                        </div>
                    </div>
                    <div class="dashboard-table responsive-table">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ $lng->Id }}</th>
                                    <th>{{ $lng->Customer }}</th>
                                    <th>{{ $lng->Status }}</th>
                                    <th>{{ $lng->Total }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr class="dashboard-table-row" data-href="{{ route('order.show', $order->id) }}">
                                        <td>
                                            <span>{{ $order->order_number }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $order->customer_first_name }} {{ $order->customer_last_name }}</span>
                                        </td>
                                        <td>
                                            <span class="text-{{ $order->statusClass() }}">{{ $order->statusText() }}</span>
                                        </td>
                                        <td>
                                            <span>{{ App\Model\Product::currencyPriceRate($order->total) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('script')
    <!-- chart js -->
    <script src="{{asset('assets/admin')}}/js/vendor/apexcharts.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/page/dashboard.js"></script>
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
      data: {!!json_encode($visitors)!!}
  }, 
    {
      name: 'Visitors',
      data: {!!json_encode($unique_visitors)!!}
    }
  ],
  grid: {
    row: {
        colors: ['transparent', 'transparent'], opacity: .2
    },
    borderColor: 'rgba(0,0,0,0.05)'
  }, 
  xaxis: {
      categories: {!!json_encode($days)!!},
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
    series: [{{$processingCount}}, {{$completedCount}}, {{$pendingCount}}, {{$cancelCount}}],
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
  @if(($completedCount+$otherCount)>0)
  series: [{{round($completedCount*100/($completedCount+$otherCount))}}, {{round($otherCount*100/($completedCount+$otherCount))}}],
  @else
  series:[0,0],
  @endif
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
              @if(($completedCount+$otherCount)>0)
              return "{{round($completedCount*100/($completedCount+$otherCount))}}%";
              @else
              return "0%";
              @endif
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
        data: {!!json_encode($organicOrders)!!}
    },{
        name: 'Coupon',
        data: {!!json_encode($couponOrders)!!}
    },{
      name: 'Affiliate',
      data: {!!json_encode($affiliateOrders)!!}
  }],         
    xaxis: {   
        categories: {!!json_encode($months)!!},
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
    data: {!!json_encode($monthOrders)!!}
  }, {
    name: 'Sale in thousand',
    data: {!!json_encode($monthSales)!!}
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
    categories: {!!json_encode($months)!!},
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
@endsection