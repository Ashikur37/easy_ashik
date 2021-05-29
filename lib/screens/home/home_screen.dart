import 'package:commerce/components/side_drawer.dart';
import 'package:flutter/material.dart';
import 'package:commerce/components/coustom_bottom_nav_bar.dart';
import 'package:commerce/enums.dart';

import 'components/body.dart';

class HomeScreen extends StatelessWidget {
  static String routeName = "/home";
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: SideDrawer(),
      body: Body(),
      bottomNavigationBar: CustomBottomNavBar(selectedMenu: MenuState.home),
    );
  }
}
