import 'package:commerce/helper/http.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

import '../../models/Product.dart';
import 'components/body.dart';
import 'components/custom_app_bar.dart';

class DetailsScreen extends StatefulWidget {
  static String routeName = "/details";

  @override
  _DetailsScreenState createState() => _DetailsScreenState();
}

class _DetailsScreenState extends State<DetailsScreen> {
  var product;
  var isLoading = true;

  void loadProduct(id) async {
    if (isLoading) {
      var prod = await getHttp("$baseUrl/products/$id");
      setState(() {
        product = prod["data"];
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    final ProductDetailsArguments agrs =
        ModalRoute.of(context).settings.arguments;
    loadProduct(agrs.productId);

    return Scaffold(
      backgroundColor: Color(0xFFF5F6F9),
      // appBar: AppBar(),
      appBar: CustomAppBar(
        rating: isLoading ? 1.0 : product["rating"].toDouble(),
      ),
      body: isLoading ? SizedBox() : Body(product: product),
    );
  }
}

class ProductDetailsArguments {
  final int productId;

  ProductDetailsArguments(this.productId);
}
