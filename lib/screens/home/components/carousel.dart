import 'package:carousel_slider/carousel_slider.dart';
import 'package:commerce/helper/http.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

class Carousel extends StatefulWidget {
  @override
  _CarouselState createState() => _CarouselState();
}

class _CarouselState extends State<Carousel> {
  List imgList = [];
  bool isLoading = true;
  void loadCarousel() async {
    if (isLoading) {
      var data = await getHttp("$baseUrl$slideUrl");
      setState(() {
        imgList = data["data"];
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    loadCarousel();
    return CarouselSlider(
      options: CarouselOptions(
        autoPlay: true,
        viewportFraction: 1.0,
        enlargeCenterPage: false,
      ),
      items: imgList
          .map((item) => GestureDetector(
                onTap: () {
                  print("tapped");
                },
                child: Container(
                  child: Center(
                      child: Image.network(item["image"],
                          fit: BoxFit.cover, width: double.infinity)),
                ),
              ))
          .toList(),
    );
  }
}
