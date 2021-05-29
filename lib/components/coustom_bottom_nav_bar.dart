import 'package:commerce/screens/campaign/campaign_screen.dart';
import 'package:commerce/screens/cart/cart_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:commerce/screens/home/home_screen.dart';
import 'package:commerce/screens/profile/profile_screen.dart';

import '../constants.dart';
import '../enums.dart';

class CustomBottomNavBar extends StatelessWidget {
  const CustomBottomNavBar({
    Key key,
    @required this.selectedMenu,
  }) : super(key: key);

  final MenuState selectedMenu;

  @override
  Widget build(BuildContext context) {
    final Color inActiveIconColor = Color(0xFFB6B6B6);
    return Container(
      padding: EdgeInsets.only(top: 10),
      decoration: BoxDecoration(
        color: Colors.white,
        boxShadow: [
          BoxShadow(
            offset: Offset(0, -15),
            blurRadius: 20,
            color: Color(0xFFDADADA).withOpacity(0.15),
          ),
        ],
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(40),
          topRight: Radius.circular(40),
        ),
      ),
      child: SafeArea(
          top: false,
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  IconButton(
                    icon: SvgPicture.asset(
                      "assets/icons/Shop Icon.svg",
                      color: MenuState.home == selectedMenu
                          ? kPrimaryColor
                          : inActiveIconColor,
                    ),
                    onPressed: () =>
                        Navigator.pushNamed(context, HomeScreen.routeName),
                  ),
                  Text("Home")
                ],
              ),
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  IconButton(
                    icon: SvgPicture.asset("assets/icons/Heart Icon.svg"),
                    onPressed: () {},
                  ),
                  Text("wishlist")
                ],
              ),
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  IconButton(
                    icon: SvgPicture.asset(
                      "assets/icons/campaign.svg",
                      color: Colors.grey,
                    ),
                    onPressed: () {
                      Navigator.pushNamed(context, CampaignScreen.routeName);
                    },
                  ),
                  Text("Campaign")
                ],
              ),
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  IconButton(
                    icon: SvgPicture.asset("assets/icons/Cart Icon.svg"),
                    onPressed: () {
                      Navigator.pushNamed(context, CartScreen.routeName);
                    },
                  ),
                  Text("Cart")
                ],
              ),
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  IconButton(
                    icon: SvgPicture.asset(
                      "assets/icons/User Icon.svg",
                      color: MenuState.profile == selectedMenu
                          ? kPrimaryColor
                          : inActiveIconColor,
                    ),
                    onPressed: () =>
                        Navigator.pushNamed(context, ProfileScreen.routeName),
                  ),
                  Text("Account")
                ],
              ),
            ],
          )),
    );
  }
}
