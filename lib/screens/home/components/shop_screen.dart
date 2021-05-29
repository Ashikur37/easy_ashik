import 'package:commerce/helper/http.dart';
import 'package:commerce/screens/shop/shops_screen.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';
import 'package:shimmer/shimmer.dart';

class ShopScreen extends StatefulWidget {
  @override
  _ShopScreenState createState() => _ShopScreenState();
}

class _ShopScreenState extends State<ShopScreen> {
  var shops;
  var isLoading = true;
  void loadShop() async {
    if (isLoading) {
      var data = await getHttp("$baseUrl$shopURL");
      setState(() {
        shops = data["data"];
        isLoading = false;
      });
    }
  }

  Widget build(BuildContext context) {
    loadShop();
    return Container(
      height: 310,
      child: Column(
        children: [
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  "Easymert Shop",
                  style: TextStyle(
                    fontSize: 18.0,
                    color: Colors.black,
                  ),
                ),
                Text("See more"),
              ],
            ),
          ),
          SizedBox(
            height: 20,
          ),
          Expanded(
            child: isLoading
                ? Shimmer.fromColors(
                    baseColor: Colors.red,
                    highlightColor: Colors.yellow,
                    child: Text(
                      'Easymert',
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        fontSize: 40.0,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  )
                : GridView.builder(
                    physics: NeverScrollableScrollPhysics(),
                    itemCount: shops.length,
                    gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                        crossAxisCount: 3),
                    itemBuilder: (BuildContext context, int index) {
                      return GestureDetector(
                        onTap: () => Navigator.pushNamed(
                          context,
                          ShopsScreen.routeName,
                          arguments: ShopsArguments(shops[index]),
                        ),
                        child: Column(
                          children: [
                            Image.network(
                              shops[index]['image'],
                              width: 100,
                            ),
                            Text(shops[index]['name']),
                          ],
                        ),
                      );
                    },
                  ),
          ),
        ],
      ),
    );
  }
}
