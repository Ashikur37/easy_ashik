import 'package:flutter/material.dart';

class LoadMore extends StatelessWidget {
  const LoadMore({
    Key key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          Text("Loading More"),
          CircularProgressIndicator(),
        ],
      ),
    );
  }
}
