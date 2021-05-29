import 'package:cached_network_image/cached_network_image.dart';
import 'package:commerce/components/load_more.dart';
import 'package:commerce/components/product_detail.dart';
import 'package:commerce/helper/http.dart';
import 'package:commerce/screens/details/details_screen.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

class ShopsScreen extends StatefulWidget {
  static String routeName = "/shop";
  @override
  _ShopsScreenState createState() => _ShopsScreenState();
}

class _ShopsScreenState extends State<ShopsScreen> {
  bool isLoading = true;
  List products = [];
  bool isLoadingMore = false;
  String nextPageURL;
  void loadProducts(id) async {
    if (isLoading) {
      var prod = await getHttp("$baseUrl/shop/$id/products");
      setState(() {
        products = prod["data"];
        isLoading = false;
        nextPageURL = prod["links"]["next"];
      });
    }
  }

  _loadMoreProducts() async {
    setState(() {
      isLoadingMore = true;
    });
    var prods = await getHttp(nextPageURL);
    setState(() {
      products.addAll(prods["data"]);
      nextPageURL = prods["links"]["next"];
      isLoadingMore = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    ScrollController _scrollController = ScrollController();
    final ShopsArguments agrs = ModalRoute.of(context).settings.arguments;
    loadProducts(agrs.shop["id"]);
    _scrollController.addListener(() {
      if (_scrollController.hasClients) {
        if (_scrollController.offset ==
            _scrollController.position.maxScrollExtent) {
          _loadMoreProducts();
        }
      }
    });
    return Scaffold(
      appBar: AppBar(
        title: Text(agrs.shop["name"]),
      ),
      body: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              Row(
                children: [
                  Icon(
                    Icons.call_outlined,
                    size: 19,
                  ),
                  Text(
                    agrs.shop["phone"],
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
              Row(
                children: [
                  Icon(Icons.location_on_outlined, size: 19),
                  Text(
                    agrs.shop["location"],
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
            ],
          ),
          SizedBox(
            height: 15,
          ),
          Expanded(
            child: GridView.builder(
              controller: _scrollController,
              itemCount: products.length,
              gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                crossAxisCount: 2,
              ),
              itemBuilder: (BuildContext context, int index) {
                return ProductDetail(product: products[index]);
              },
            ),
          ),
          isLoadingMore ? LoadMore() : SizedBox()
        ],
      ),
    );
  }
}

class ShopsArguments {
  final shop;
  ShopsArguments(this.shop);
}
