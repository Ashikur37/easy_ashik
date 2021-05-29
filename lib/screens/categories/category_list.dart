import 'package:commerce/providers/category_provider.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class CategoryList extends StatelessWidget {
  final List categories;
  final Function loadProducts;
  final String activeCategory;
  const CategoryList({
    this.categories,
    this.loadProducts,
    this.activeCategory,
  });
  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Container(
        color: Colors.grey.shade100,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: List.generate(
            categories.length,
            (index) => GestureDetector(
              onTap: () {
                var provider =
                    Provider.of<CategoryProvider>(context, listen: false);
                provider.activeCategory = categories[index]["name"];
                var catId = categories[index]["id"];
                loadProducts(catId);
                provider.notifyListeners();
              },
              child: Container(
                height: 105,
                width: 100,
                child: Container(
                  decoration: BoxDecoration(
                    border: Border(
                      left: BorderSide(
                          color: Colors.redAccent,
                          width: activeCategory == categories[index]["name"]
                              ? 2
                              : 0),
                      bottom: BorderSide(color: Colors.white, width: 2.0),
                    ),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      SizedBox(
                        height: 10,
                      ),
                      Image.network(
                        categories[index]["image"],
                        width: 50,
                      ),
                      SizedBox(
                        height: 10,
                      ),
                      Text(
                        categories[index]["name"],
                        textAlign: TextAlign.center,
                        overflow: TextOverflow.ellipsis,
                        maxLines: 2,
                        style: TextStyle(
                          fontSize: 11,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
