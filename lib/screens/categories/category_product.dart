import 'package:commerce/components/product_detail.dart';
import 'package:flutter/material.dart';

class CategoryProduct extends StatelessWidget {
  final List products;
  final ScrollController scrollController;
  const CategoryProduct({
    this.products,
    this.scrollController,
  });
  @override
  Widget build(BuildContext context) {
    return Expanded(
      child: GridView.builder(
        controller: scrollController,
        itemCount: products.length,
        gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
          crossAxisCount: 2,
          crossAxisSpacing: 2.0,
          mainAxisSpacing: 5.0,
        ),
        itemBuilder: (BuildContext context, int index) {
          return ProductDetail(product: products[index]);
        },
      ),
    );
  }
}
