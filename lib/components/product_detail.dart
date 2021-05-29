import 'package:cached_network_image/cached_network_image.dart';
import 'package:commerce/screens/details/details_screen.dart';
import 'package:flutter/material.dart';

class ProductDetail extends StatelessWidget {
  const ProductDetail({
    Key key,
    @required this.product,
  }) : super(key: key);

  final product;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        // Navigator.pushNamed(
        //   context,
        //   DetailsScreen.routeName,
        //   arguments: ProductDetailsArguments(product["id"]),
        // );
      },
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          CachedNetworkImage(
            imageUrl: product['image'],
            width: 150,
            height: 100,
            placeholder: (context, url) => CircularProgressIndicator(),
            errorWidget: (context, url, error) => Icon(Icons.error),
          ),
          Text(
            product['name'],
            textAlign: TextAlign.center,
            overflow: TextOverflow.ellipsis,
            maxLines: 2,
            style: TextStyle(fontWeight: FontWeight.w600),
          ),
        ],
      ),
    );
  }
}
