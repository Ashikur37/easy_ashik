import 'package:commerce/components/product_detail.dart';
import 'package:commerce/helper/http.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

import '../../constants.dart';
import '../../size_config.dart';

class SearchScreen extends StatefulWidget {
  static String routeName = "/search";
  @override
  _SearchScreenState createState() => _SearchScreenState();
}

class _SearchScreenState extends State<SearchScreen> {
  List products = [];
  bool isLoading = false;
  String key = "";
  void loadProducts(param) async {
    if (param.length > 0) {
      var prod = await getHttp("$baseUrl$productSearchUrl/$param");
      print("$baseUrl/$productSearchUrl/$param");
      setState(() {
        products = prod["data"];
        isLoading = false;
        key = param;
      });
    }
  }

  void loadMoreProducts() async {}
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Column(
          children: [
            SizedBox(height: getProportionateScreenHeight(20)),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                Container(
                  margin: EdgeInsets.only(left: SizeConfig.screenWidth * 0.1),
                  width: SizeConfig.screenWidth * 0.7,
                  decoration: BoxDecoration(
                    color: kSecondaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: TextField(
                    autofocus: true,
                    onChanged: (value) => loadProducts(value),
                    decoration: InputDecoration(
                        contentPadding: EdgeInsets.symmetric(
                            horizontal: getProportionateScreenWidth(20),
                            vertical: getProportionateScreenWidth(9)),
                        border: InputBorder.none,
                        focusedBorder: InputBorder.none,
                        enabledBorder: InputBorder.none,
                        hintText: "Search product",
                        prefixIcon: Icon(Icons.search)),
                  ),
                ),
                GestureDetector(
                  onTap: () => Navigator.pop(context),
                  child: Text(
                    "Cancel",
                    style: TextStyle(fontWeight: FontWeight.w600),
                  ),
                )
              ],
            ),
            SizedBox(height: getProportionateScreenHeight(20)),
            Expanded(
              child: GridView.builder(
                itemCount: products.length,
                gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 2,
                ),
                itemBuilder: (BuildContext context, int index) {
                  return ProductDetail(product: products[index]);
                  ;
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
