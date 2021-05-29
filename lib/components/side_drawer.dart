import 'package:commerce/constants.dart';
import 'package:commerce/screens/cart/cart_screen.dart';
import 'package:commerce/screens/home/home_screen.dart';
import 'package:commerce/screens/login_success/login_success_screen.dart';
import 'package:commerce/screens/sign_in/sign_in_screen.dart';
import 'package:flutter/material.dart';

class SideDrawer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      // Add a ListView to the drawer. This ensures the user can scroll
      // through the options in the drawer if there isn't enough vertical
      // space to fit everything.
      child: ListView(
        // Important: Remove any padding from the ListView.
        padding: EdgeInsets.zero,
        children: <Widget>[
          DrawerHeader(
            child: Column(
              children: [
                Text(
                  'Easymert',
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    color: kPrimaryColor,
                    fontSize: 28,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      "কেনাকাটা হরদম ",
                      style: TextStyle(fontSize: 18),
                    ),
                    Text(
                      "Easymert.com",
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    )
                  ],
                )
              ],
            ),
            decoration: BoxDecoration(),
          ),
          ListTile(
            title: Row(children: [
              Icon(Icons.home_outlined),
              SizedBox(
                width: 10,
              ),
              Text(
                'Home',
                style: TextStyle(
                  fontSize: 15,
                  color: Colors.black,
                ),
              ),
            ]),
            onTap: () {
              Navigator.pushNamed(context, HomeScreen.routeName);
            },
          ),
          ListTile(
            title: Row(children: [
              Icon(Icons.account_circle_outlined),
              SizedBox(
                width: 10,
              ),
              Text(
                'Dashboard',
                style: TextStyle(
                  fontSize: 15,
                  color: Colors.black,
                ),
              ),
            ]),
            onTap: () {
              Navigator.popAndPushNamed(context, SignInScreen.routeName);
            },
          ),
          ListTile(
            title: Row(children: [
              Icon(Icons.shopping_bag_outlined),
              SizedBox(
                width: 10,
              ),
              Text(
                'Cart',
                style: TextStyle(
                  fontSize: 15,
                  color: Colors.black,
                ),
              ),
            ]),
            onTap: () {
              Navigator.popAndPushNamed(context, CartScreen.routeName);
            },
          ),
        ],
      ),
    );
  }
}
