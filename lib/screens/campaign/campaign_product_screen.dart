import 'package:commerce/components/load_more.dart';
import 'package:commerce/components/product_detail.dart';
import 'package:commerce/helper/http.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

class CampaignProductScreen extends StatefulWidget {
  static String routeName = "/campaign_product";
  @override
  _CampaignProductScreenState createState() => _CampaignProductScreenState();
}

class _CampaignProductScreenState extends State<CampaignProductScreen> {
  bool isLoading = true;
  List products = [];
  bool isLoadingMore = false;
  String nextPageURL;
  void loadProducts(id) async {
    if (isLoading) {
      var prod = await getHttp("$baseUrl/campaign/$id/products");
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
    final CampaignProductArguments agrs =
        ModalRoute.of(context).settings.arguments;
    loadProducts(agrs.campaign["id"]);
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
        title: Text(agrs.campaign["title"]),
      ),
      body: Column(
        children: [
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

class CampaignProductArguments {
  final campaign;
  CampaignProductArguments(this.campaign);
}
