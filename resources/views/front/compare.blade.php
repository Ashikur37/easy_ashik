@extends('layouts.front')
@section('title', "$lng->ProductComparison")
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/compare.css">
@endsection
@section('content')
<div class="product-compare-page" id="product__compare__page">   
    @if(count($items)>0)
    <div class="container white-bg">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <h2 class="header-title">{{$lng->ProductComparison}}</h2>
            </div>
        </div>
    </div>
    <div class="container white-bg">
       <div class="row">
            <div class="col-xl-10 offset-xl-1">
                 <div class="d-flex mb-5">
                    <div class="content-left">
                        <span class="image">{{$lng->Product}}</span>
                        <span class="title gray same-height">{{$lng->Name}}</span>
                        <span class="desc">{{$lng->Description}}</span>
                        <span class="rating gray same-height"> {{$lng->Rating}} </span>
                        <span class="price same-height">{{$lng->Price}}</span>
                        <span class="availability gray same-height">{{$lng->Availability}}</span>
                        <span class="size same-height">{{$lng->Size}}</span>
                        <span class="color gray same-height">{{$lng->Color}}</span>
                        <span class="brand same-height">{{$lng->Brand}}</span>
                        <span class="actions gray same-height">{{$lng->Action}}</span>
                    </div>
                    <div class="content-right">
                        <div class="all-products" id="dynamic-compare">
                            @include('load.front.compare')
                        </div>
                    </div>
                </div>
            </div>     
       </div>
    </div>
    @else
    <div class="container my-5">
       <div class="empty-product">
        <svg width="100%" height="100%" viewBox="0 0 466 336" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/">
            <g transform="matrix(1,0,0,1,-1382,-1411.24)">
                <g transform="matrix(0.981354,0,0,0.994036,-1238.38,1100)">
                    <g transform="matrix(1.019,0,0,1.006,1261.91,-1202.74)">
                        <path d="M1846.84,1716.31C1846.75,1715.88 1846.61,1715.47 1846.41,1715C1844.71,1710.85 1791.26,1579.33 1771.7,1535.58C1771.22,1534.5 1771.24,1533.25 1771.76,1532.19C1772.28,1531.12 1773.25,1530.34 1774.4,1530.06C1777.36,1529.34 1779.55,1526.66 1779.55,1523.49C1779.55,1519.75 1776.52,1516.71 1772.78,1516.71C1772.74,1516.71 1772.7,1516.71 1772.67,1516.72L1651.39,1530.12C1649.68,1530.31 1648.05,1529.38 1647.32,1527.82C1641.6,1515.42 1629.05,1506.8 1614.5,1506.8C1597.16,1506.8 1582.66,1519.04 1579.17,1535.34C1578.81,1537.03 1577.41,1538.29 1575.69,1538.48L1459.3,1551.34C1459.2,1551.35 1459.09,1551.36 1458.99,1551.36C1455.36,1551.48 1452.44,1554.46 1452.44,1558.12C1452.44,1560.83 1454.03,1563.16 1456.32,1564.25C1458.29,1565.18 1459.15,1567.51 1458.26,1569.5C1438.67,1613.26 1385.44,1742.7 1382.62,1749.56L1382.13,1751.11L1382.07,1751.43C1382.02,1751.8 1381.99,1752.16 1382,1752.59C1382.06,1801.87 1422.08,1841.86 1471.43,1841.86C1520.79,1841.86 1560.8,1801.87 1560.86,1752.51C1560.86,1752.48 1560.86,1752.46 1560.86,1752.44C1560.87,1752.13 1560.84,1751.79 1560.79,1751.43L1560.7,1750.95C1560.61,1750.52 1560.47,1750.11 1560.27,1749.64C1558.57,1745.51 1504.61,1614.24 1484.71,1569.75C1484.19,1568.58 1484.26,1567.24 1484.89,1566.13C1485.53,1565.02 1486.65,1564.28 1487.93,1564.14L1576.99,1554.36C1578.76,1554.16 1580.44,1555.15 1581.12,1556.8C1586.56,1569.87 1599.46,1579.07 1614.5,1579.07C1632.3,1579.07 1647.11,1566.18 1650.09,1549.23C1650.4,1547.47 1651.82,1546.14 1653.59,1545.94L1737.09,1536.77C1738.51,1536.61 1739.91,1537.23 1740.76,1538.39C1741.6,1539.54 1741.76,1541.06 1741.18,1542.37C1720.95,1587.85 1670.4,1710.93 1668.69,1715.1C1668.68,1715.12 1668.67,1715.15 1668.66,1715.17C1668.52,1715.5 1668.39,1715.9 1668.3,1716.31L1668.21,1716.79C1668.16,1717.16 1668.13,1717.53 1668.14,1717.95C1668.2,1767.23 1708.22,1807.22 1757.57,1807.22C1806.93,1807.22 1846.94,1767.23 1847,1717.87C1847,1717.85 1847,1717.82 1847,1717.8C1847.01,1717.5 1846.98,1717.15 1846.93,1716.8L1846.84,1716.31ZM1546.47,1763.78C1546.64,1762.63 1546.3,1761.46 1545.54,1760.57C1544.78,1759.69 1543.67,1759.18 1542.51,1759.18L1400.35,1759.18C1399.18,1759.18 1398.08,1759.69 1397.32,1760.57C1396.56,1761.46 1396.22,1762.63 1396.39,1763.78C1401.88,1800.31 1433.38,1828.31 1471.43,1828.31C1509.48,1828.31 1540.98,1800.31 1546.47,1763.78ZM1832.61,1729.14C1832.78,1727.99 1832.44,1726.82 1831.68,1725.94C1830.92,1725.05 1829.82,1724.55 1828.65,1724.55L1686.49,1724.55C1685.33,1724.55 1684.22,1725.05 1683.46,1725.94C1682.7,1726.82 1682.36,1727.99 1682.53,1729.14C1688.02,1765.67 1719.52,1793.67 1757.57,1793.67C1795.62,1793.67 1827.12,1765.67 1832.61,1729.14ZM1475.09,1581.46C1474.45,1580.01 1473.02,1579.07 1471.43,1579.07C1469.84,1579.07 1468.41,1580.01 1467.77,1581.46C1450.48,1620.79 1415.33,1705.74 1401.16,1740.11C1400.65,1741.35 1400.8,1742.75 1401.54,1743.86C1402.28,1744.97 1403.53,1745.64 1404.86,1745.64L1538,1745.64C1539.33,1745.64 1540.58,1744.97 1541.32,1743.86C1542.06,1742.75 1542.2,1741.35 1541.7,1740.11C1527.53,1705.75 1492.38,1620.8 1475.09,1581.46ZM1471.3,1713.11L1471.3,1724.55L1459.5,1724.55L1459.5,1713.11L1471.3,1713.11ZM1761.23,1546.82C1760.59,1545.37 1759.16,1544.43 1757.57,1544.43C1755.98,1544.43 1754.55,1545.37 1753.91,1546.82C1736.62,1586.15 1701.48,1671.11 1687.31,1705.48C1686.8,1706.71 1686.94,1708.12 1687.68,1709.22C1688.42,1710.33 1689.67,1711 1691,1711L1824.14,1711C1825.47,1711 1826.72,1710.33 1827.46,1709.22C1828.2,1708.12 1828.35,1706.71 1827.84,1705.48C1813.67,1671.11 1778.53,1586.16 1761.23,1546.82ZM1472.02,1657.4C1478.07,1657.4 1482.91,1659.03 1486.54,1662.3C1490.16,1665.56 1491.98,1670.1 1491.98,1675.91C1491.98,1682.2 1490.03,1686.93 1486.13,1690.11C1482.23,1693.29 1476.92,1694.93 1470.21,1695.05L1470.21,1705.04L1460.41,1705.04L1460.41,1688.16L1464.76,1688.16C1470.03,1688.16 1474.17,1687.3 1477.19,1685.57C1480.22,1683.85 1481.73,1680.66 1481.73,1676C1481.73,1672.85 1480.82,1670.39 1479.01,1668.6C1477.19,1666.82 1474.74,1665.93 1471.66,1665.93C1468.39,1665.93 1465.76,1666.86 1463.77,1668.74C1461.77,1670.61 1460.77,1673.06 1460.77,1676.09L1450.88,1676.09C1450.82,1672.46 1451.64,1669.24 1453.33,1666.42C1455.03,1663.61 1457.48,1661.4 1460.68,1659.8C1463.89,1658.2 1467.67,1657.4 1472.02,1657.4ZM1759.82,1682.16L1759.82,1693.6L1748.02,1693.6L1748.02,1682.16L1759.82,1682.16ZM1760.54,1626.45C1766.59,1626.45 1771.43,1628.08 1775.06,1631.35C1778.69,1634.61 1780.5,1639.15 1780.5,1644.96C1780.5,1651.25 1778.55,1655.98 1774.65,1659.16C1770.75,1662.34 1765.44,1663.98 1758.73,1664.11L1758.73,1674.09L1748.93,1674.09L1748.93,1657.21L1753.28,1657.21C1758.55,1657.21 1762.69,1656.35 1765.71,1654.62C1768.74,1652.9 1770.25,1649.71 1770.25,1645.05C1770.25,1641.9 1769.34,1639.44 1767.53,1637.65C1765.71,1635.87 1763.26,1634.98 1760.18,1634.98C1756.91,1634.98 1754.28,1635.91 1752.29,1637.79C1750.29,1639.66 1749.29,1642.12 1749.29,1645.14L1739.4,1645.14C1739.34,1641.51 1740.16,1638.29 1741.85,1635.48C1743.55,1632.66 1746,1630.45 1749.2,1628.85C1752.41,1627.25 1756.19,1626.45 1760.54,1626.45ZM1614.5,1523.49C1603.76,1523.49 1595.05,1532.2 1595.05,1542.94C1595.05,1553.67 1603.76,1562.39 1614.5,1562.39C1625.24,1562.39 1633.95,1553.67 1633.95,1542.94C1633.95,1532.2 1625.24,1523.49 1614.5,1523.49Z"/>
                    </g>
                </g>
            </g>
        </svg>
        <h4>{{$lng->NothingToCompare}}</h4>    
       </div>
    </div>
    @endif 
</div>
@endsection
@section('pageScripts')
<script src="{{asset('front')}}/js/page/compare.js"></script>
@endsection